package me.fru1t.steam.csgoderankers;

import java.io.BufferedWriter;
import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;
import java.io.StringWriter;
import java.text.SimpleDateFormat;
import java.util.Date;

import me.fru1t.annotation.Nullable;
import me.fru1t.steam.csgoderankers.processes.LobbyPostServerSocketProcess;
import me.fru1t.steam.csgoderankers.processes.ScrapeProcess;
import me.fru1t.steam.csgoderankers.processes.StatsProcess;

public class Boot {
	private static final SimpleDateFormat sdf = new SimpleDateFormat("EEE, dd MMM yyyy HH:mm:ss z");
	private static BufferedWriter logWriter = null;
	
	private static final String getTimestampPrefix() {
		return "[" + sdf.format(new Date()) + "] ";
	}
	
	public static final void print(String message) {
		System.out.println(getTimestampPrefix() + message);
	}
	
	public static final String log(String message) {
		// Log to console
		System.out.println(getTimestampPrefix() + message);
		
		// Log to file
		if (logWriter == null) {
			try {
				System.out.println(getTimestampPrefix() + "Creating new log file");
				logWriter = new BufferedWriter(new FileWriter(
						"bin/csgoderankers-" + (new Date()).getTime() + ".log", true));
			} catch (IOException e) {
				e.printStackTrace();
				System.out.println(getTimestampPrefix()
						+ "Couldn't create log file: "
						+ e.getMessage());
			}
			return message;
		}
		
		try {
			logWriter.write(getTimestampPrefix() + message + "\r\n");
		} catch (IOException e) {
			e.printStackTrace();
			System.out.println(getTimestampPrefix()
					+ "Couldn't write to log file: "
					+ e.getMessage());
		}
		return message;
	}
	
	public static final void log(Exception e) {
		StringWriter errors = new StringWriter();
		e.printStackTrace(new PrintWriter(errors));
		Boot.log(errors.toString());
	}
	
	public static final String handleException(Exception e, @Nullable String userMessage) {
		int check = (int) (Math.random() * Integer.MAX_VALUE);
		StringWriter errors = new StringWriter();
		e.printStackTrace(new PrintWriter(errors));
		Boot.log(errors.toString() + " [" + check  + "]");
		return ((userMessage == null) ? "" : userMessage) + " [Error ID: " + check + "]";
	}
	
	public static void main(String[] args) {
		log("Starting up steamcommunity scraper...");
		(new Thread(new ScrapeProcess())).start();
		(new Thread(new LobbyPostServerSocketProcess())).start();
		(new Thread(new StatsProcess())).start();
	}
}
