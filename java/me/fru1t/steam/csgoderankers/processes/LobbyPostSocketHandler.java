package me.fru1t.steam.csgoderankers.processes;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.Socket;
import java.nio.charset.StandardCharsets;

import com.google.gson.Gson;

import me.fru1t.steam.csgoderankers.Boot;
import me.fru1t.steam.csgoderankers.Process;

public class LobbyPostSocketHandler implements Runnable {
	private Socket socket;
	public LobbyPostSocketHandler(Socket socket) {
		this.socket = socket;
	}
	
	@Override
	public void run() {
		Boot.print("Handling post request...");
		try {
			BufferedReader in = new BufferedReader(new InputStreamReader(socket.getInputStream()));
			OutputStreamWriter osw = new OutputStreamWriter(
					socket.getOutputStream(),
					StandardCharsets.UTF_8.name());

			String postString = in.readLine();
			LobbyPostJson lpj = (new Gson()).fromJson(postString, LobbyPostJson.class);
			osw.write(Process.processAndPostLobbyPostFromWebsite(lpj.text, lpj.ip) + "\n");
			osw.flush();
			
			in.close();
			osw.close();
		} catch (IOException e) {
			e.printStackTrace();
		}
		
		try {
			socket.close();
		} catch (IOException e) {
			e.printStackTrace();
		}
		Boot.print("Completed transaction");
	}
	
	private static class LobbyPostJson {
		public String ip;
		public String text;
	}
}
