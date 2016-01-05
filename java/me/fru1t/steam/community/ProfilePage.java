package me.fru1t.steam.community;

import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.select.Elements;

import me.fru1t.net.URL;

public class ProfilePage {
	private static final String NAME_SELECTOR =
			".profile_header_centered_persona .actual_persona_name";
	public static enum IdType {
		ID("http://steamcommunity.com/id/%s"),
		STEAM64("http://steamcommunity.com/profiles/%s");
		
		private String url;
		private IdType(String url) {
			this.url = url;
		}
		
		public String getUrl(String id) {
			return String.format(url, id);
		}
	}
	
	private Document document;
	public ProfilePage(IdType idType, String id) {
		document = Jsoup.parse(URL.getContents(idType.getUrl(id)));
	}
	
	public ProfilePage(long steam64) {
		this(IdType.STEAM64, Long.toString(steam64));
	}
	
	public String getName() {
		Elements nameEls = document.select(NAME_SELECTOR);
		if (nameEls.size() != 1) {
			return "";
		}
		return nameEls.get(0).ownText();
	}
}
