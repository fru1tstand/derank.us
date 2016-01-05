package me.fru1t.steam.csgoderankers.processes;

import me.fru1t.steam.csgoderankers.Process;

public class StatsProcess implements Runnable {
	private static final int PRINT_DELAY = 60;
	
	@Override
	public void run() {
		while (true) {
			Process.printProcessStatistics();
			try {
				Thread.sleep(1000 * PRINT_DELAY);
			} catch (InterruptedException e) {
				e.printStackTrace();
				return;
			}
		}
	}
}
