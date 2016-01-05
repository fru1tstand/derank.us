package me.fru1t.net;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.URLConnection;
import java.nio.charset.StandardCharsets;

import me.fru1t.annotation.Nullable;
import me.fru1t.steam.csgoderankers.Boot;

/**
 * Contains convenience methods for urls.
 */
public class URL {
	@Nullable
	public static String getContents(String url) {
		StringBuilder response = new StringBuilder();
		try {
			java.net.URL website = new java.net.URL(url);
			URLConnection conn = website.openConnection();
			BufferedReader in = new BufferedReader(
					new InputStreamReader(conn.getInputStream(), StandardCharsets.UTF_8));
			while (in.ready()) {
				response.append(in.readLine());
			}
			in.close();
			return response.toString();
		} catch (Exception e) {
			Boot.log(e);
			return null;
		}
	}
}
