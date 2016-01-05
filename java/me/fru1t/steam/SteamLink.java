package me.fru1t.steam;

import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class SteamLink {
	private static final String GENERIC_STEAM_LINK = "steam://%s";
	public static final Pattern CSGO_JOINLOBBY =
			Pattern.compile(String.format(GENERIC_STEAM_LINK, "joinlobby/730/(\\d+)/(\\d+)"));
	private static final Pattern MULTI_WHITESPACE = Pattern.compile("\\s{2,}");
	
	/**
	 * Collapses all spaces from a given string into a single space.
	 * 
	 * @param s
	 * @return
	 */
	public static final String collapseWhitespace(String s) {
		Matcher whitespaceMatch = MULTI_WHITESPACE.matcher(s);
		return whitespaceMatch.replaceAll(" ");
	}
}
