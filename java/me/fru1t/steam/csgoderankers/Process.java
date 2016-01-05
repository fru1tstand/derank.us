package me.fru1t.steam.csgoderankers;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import java.util.regex.Matcher;

import me.fru1t.steam.SteamLink;
import me.fru1t.steam.community.GroupCommentPage;
import me.fru1t.steam.community.ProfilePage;
import me.fru1t.steam.csgoderankers.database.Queries;
import me.fru1t.steam.csgoderankers.database.SpAddLobbyPostFromSteam;
import me.fru1t.steam.csgoderankers.database.SpAddLobbyPostFromWebsite;
import me.fru1t.steam.csgoderankers.database.TblLobbyPost;

/**
 * The brains of the csgo deranking operation
 */
public class Process {
	private static final long MIN_LOBBY_ID = 109775242593613542L;
	private static final long MAX_LOBBY_ID = 199775242593613542L;
	private static final long MIN_PROFILE_ID = 76561190960305380L;
	private static final long MAX_PROFILE_ID = 76561250271716216L;
	
	/* The time between two unique IPs posting the same lobby ID */
	private static final int LOBBY_IP_MINUTES = 10;
	
	private static long processedLobbyPosts = 0;
	private static long processedValidLobbyPosts = 0;
	
	public static List<SpAddLobbyPostFromSteam> processGroupComments(
			List<GroupCommentPage.Comment> comments) {
		List<SpAddLobbyPostFromSteam> lobbyPosts = new ArrayList<>();
		
		for (GroupCommentPage.Comment comment : comments) {
			if (comment.commentId < 1) {
				Boot.print("Ignored an invalid comment id");
				continue;
			}
			
			SpAddLobbyPostFromSteam lobbyPost = new SpAddLobbyPostFromSteam();
			
			if (!populateLobbyPostLinkInformation(lobbyPost, comment.text)) {
				continue;
			}
			
			lobbyPost.commentId = comment.commentId;
			lobbyPost.displayName = comment.authorName;
			lobbyPost.postDate = comment.timestamp;
			
			lobbyPosts.add(lobbyPost);
		}
		
		return lobbyPosts;
	}
	
	public static String processAndPostLobbyPostFromWebsite(String post, String ip) {
		SpAddLobbyPostFromWebsite lobbyPost = new SpAddLobbyPostFromWebsite();
		if (!populateLobbyPostLinkInformation(lobbyPost, post)) {
			return "No valid lobby link was found in the post.";
		}

		// Easy stuff
		lobbyPost.postDate = (int) ((new Date()).getTime() / 1000);
		lobbyPost.ip = ip;
		lobbyPost.lobbyIpMinutes = LOBBY_IP_MINUTES;
		
		// Profile
		lobbyPost.displayName = "";
		try {
			ProfilePage profile = new ProfilePage(lobbyPost.profileId);
			lobbyPost.displayName = profile.getName();
		} catch (Exception e) {
			Boot.log(e);
		}
		
		return Queries.spAddLobbyPostFromWebsite(lobbyPost);
	}
	
	public static void printProcessStatistics() {
		Boot.print("Processed: " + processedLobbyPosts
				+ "  Valid: " + processedValidLobbyPosts
				+ "  Invalid: " + (processedLobbyPosts - processedValidLobbyPosts));
	}
	
	private static boolean populateLobbyPostLinkInformation(
			TblLobbyPost lobbyPost, String commentText) {
		processedLobbyPosts++;
		
		Matcher linkMatcher = SteamLink.CSGO_JOINLOBBY.matcher(commentText);
		if (!linkMatcher.find()) {
			Boot.print("Ignored no lobby link comment: " + commentText);
			return false;
		}
		
		lobbyPost.lobbyId = Long.parseLong(linkMatcher.group(1));
		lobbyPost.profileId = Long.parseLong(linkMatcher.group(2));
		lobbyPost.title = SteamLink.collapseWhitespace(linkMatcher.replaceAll("")).trim();
		
		if (lobbyPost.lobbyId < MIN_LOBBY_ID) {
			Boot.print("Ignored too low lobby id: " + lobbyPost.lobbyId);
			return false;
		}
		if (lobbyPost.lobbyId > MAX_LOBBY_ID) {
			Boot.print("Ignored too high lobby id: " + lobbyPost.lobbyId);
			return false;
		}
		if (lobbyPost.profileId < MIN_PROFILE_ID) {
			Boot.print("Ignored too low profile id: " + lobbyPost.profileId);
			return false;
		}
		if (lobbyPost.profileId > MAX_PROFILE_ID) {
			Boot.print("Ignored too high profile id: " + lobbyPost.profileId);
			return false;
		}
		
		processedValidLobbyPosts++;
		return true;
	}
}
