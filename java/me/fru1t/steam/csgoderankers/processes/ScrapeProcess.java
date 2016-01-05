package me.fru1t.steam.csgoderankers.processes;

import java.util.Date;
import java.util.List;

import me.fru1t.steam.community.GroupCommentPage;
import me.fru1t.steam.csgoderankers.Boot;
import me.fru1t.steam.csgoderankers.Process;
import me.fru1t.steam.csgoderankers.database.Queries;
import me.fru1t.steam.csgoderankers.database.SpAddLobbyPostFromSteam;

public class ScrapeProcess implements Runnable {
	private static final String GROUP_ID = "103582791435385270";
	private static final double SCRAPE_DELAY_MINUTES = 2.5;
	
	@Override
	public void run() {
		while (true) {
			Boot.log("Scraping steam community...");
			long startScrapeTime = (new Date()).getTime();
			
			List<GroupCommentPage.Comment> comments = GroupCommentPage.getComments(GROUP_ID);
			List<SpAddLobbyPostFromSteam> lobbyPosts = Process.processGroupComments(comments);
			Queries.spAddLobbyPostFromSteam_Batch(lobbyPosts);
			
			// store comments and sanitize
			Boot.log("Finished scrape in "
					+ ((new Date()).getTime() - startScrapeTime)
					+ "ms");
			
			try {
				Thread.sleep((int) (1000 * 60 * SCRAPE_DELAY_MINUTES));
			} catch (InterruptedException e) {
				Boot.log(e);
				break;
			}
		}
	}
}
