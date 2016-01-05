package me.fru1t.steam.csgoderankers.processes;

import java.io.IOException;
import java.net.ServerSocket;

public class LobbyPostServerSocketProcess implements Runnable {
	private static final int SERVER_PORT = 27020;
	private static final int SERVER_BACKLOG = 20;
	
	@Override
	public void run() {
		ServerSocket providerSocket;
		try {
			providerSocket = new ServerSocket(SERVER_PORT, SERVER_BACKLOG);
		} catch (IOException e1) {
			e1.printStackTrace();
			return;
		}
		
		while (true) {
			try {
				(new Thread(new LobbyPostSocketHandler(providerSocket.accept()))).run();
			} catch (IOException e1) {
				e1.printStackTrace();
			}
			
			try {
				// Let the computer sleep
				Thread.sleep(300);
			} catch (InterruptedException e) {
				e.printStackTrace();
				break;
			}
		}
		
		try {
			providerSocket.close();
		} catch (IOException e1) {
			e1.printStackTrace();
		}
	}
}
