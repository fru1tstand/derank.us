package me.fru1t.steam.community;

import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.List;
import java.util.TimeZone;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import org.jsoup.Jsoup;
import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;

import com.google.gson.JsonParser;

import me.fru1t.net.URL;
import me.fru1t.steam.csgoderankers.Boot;
import me.fru1t.steam.csgoderankers.database.Queries;

public class GroupCommentPage {
	private static final String STEAM_GROUP_JSON_URL =
			"http://steamcommunity.com/comment/Clan/render/%s/-1/?count=25";
	private static final String JSON_COMMENT_MEMBER_NAME = "comments_html";
	
	private static final String DUMP_TYPE_NAME_PREFIX = "steam-community-id-";
	
	/* Comment HTML */
	private static final String COMMENT_SELECTOR =
			".commentthread_comment.responsive_body_text";
	private static final String COMMENT_TEXT_SELECTOR =
			".commentthread_comment_content .commentthread_comment_text";
	private static final String COMMENT_AUTHOR_SELECTOR =
			".commentthread_comment_content .commentthread_comment_author a";
	private static final String COMMENT_TIMESTAMP_SELECTOR =
			".commentthread_comment_content .commentthread_comment_author .commentthread_comment_timestamp";
	private static final String COMMENT_AVATAR_SELECTOR =
			".commentthread_comment_avatar a img";
	
	/* Comment processing */
	private static final TimeZone GMT_TIMEZONE = TimeZone.getTimeZone("GMT");
	private static final Pattern TIMESTAMP_MINUTES = Pattern.compile("(\\d+) minutes ago.+");
	private static final Pattern COMMENT_ID = Pattern.compile("comment_(\\d+)");
	
	private static JsonParser parser;
	
	public static List<Comment> getComments(String groupId) {
		List<Comment> comments = new ArrayList<>();
		
		// Get ajax json
		String ajaxJsonString = URL.getContents(String.format(STEAM_GROUP_JSON_URL, groupId));
		if (ajaxJsonString == null) {
			Boot.log("GroupCommentPage#getComments json returned null.");
			return comments;
		}
		Queries.spAddDump(DUMP_TYPE_NAME_PREFIX + groupId,
				(int) ((new Date()).getTime() / 1000),
				ajaxJsonString);

		// Extract html from json
		String commentsHtml = getJsonParser()
				.parse(ajaxJsonString)
				.getAsJsonObject()
				.get(JSON_COMMENT_MEMBER_NAME)
				.getAsString();
		
		// Process html as comments
		Elements commentEls = Jsoup.parseBodyFragment(commentsHtml).select(COMMENT_SELECTOR);
		for (Element commentEl : commentEls) {
			Comment comment = new Comment();
			
			// CommentId
			comment.commentId = getCommentIdFromString(commentEl.id());
			
			// Text
			Elements textEls = commentEl.select(COMMENT_TEXT_SELECTOR);
			if (textEls.size() > 0) {
				comment.text = textEls.get(0).ownText();
			}
			
			// Author name & link
			Elements authorEls = commentEl.select(COMMENT_AUTHOR_SELECTOR);
			if (authorEls.size() > 0) {
				comment.authorLink = authorEls.get(0).attr("href");
				comment.authorName = authorEls.get(0).text();
			}
			
			// Timestamp
			Elements timestampEls = commentEl.select(COMMENT_TIMESTAMP_SELECTOR);
			if (timestampEls.size() > 0) {
				comment.timestamp = getUnixTimestampFromString(timestampEls.get(0).ownText());
			}
			
			// Avatar
			Elements avatarEls = commentEl.select(COMMENT_AVATAR_SELECTOR);
			if (avatarEls.size() > 0) {
				comment.authorImage = avatarEls.get(0).attr("src");
			}
			
			comments.add(comment);
		}
		
		return comments;
	}
	
	private static JsonParser getJsonParser() {
		if (parser == null) {
			parser = new JsonParser();
		}
		return parser;
	}
	
	private static int getUnixTimestampFromString(String s) {
		Calendar cal = Calendar.getInstance(GMT_TIMEZONE);
		cal.set(Calendar.MILLISECOND, 0);
		cal.set(Calendar.SECOND, 0);
		
		int minutesAgo = 1;
		Matcher minuteMatch = TIMESTAMP_MINUTES.matcher(s);
		if (minuteMatch.matches()) {
			minutesAgo = Integer.parseInt(minuteMatch.group(1));
		}
		
		cal.add(Calendar.MINUTE, minutesAgo * -1);
		
		return (int) (cal.getTimeInMillis() / 1000);
	}
	
	private static long getCommentIdFromString(String s) {
		Matcher idMatcher = COMMENT_ID.matcher(s);
		if (idMatcher.matches()) {
			return Long.parseLong(idMatcher.group(1));
		}
		
		return -1;
	}
	
	public static class Comment {
		public String text;
		public String authorName;
		public String authorLink;
		public String authorImage;
		public int timestamp;
		public long commentId;
	}
}
