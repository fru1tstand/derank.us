package me.fru1t.steam.csgoderankers.database;

import java.sql.CallableStatement;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.sql.Types;
import java.util.List;

import me.fru1t.annotation.Nullable;
import me.fru1t.steam.csgoderankers.Boot;

public class Queries {
	/**
	 * 1 IN lobby_id BIGINT,
	 * 2 IN display_name VARCHAR(64),
	 * 3 IN post_date INT,
	 * 4 IN profile_id BIGINT,
	 * 5 IN title TEXT,
	 * 6 IN ip VARCHAR(65),
	 * 7 IN lobby_ip_minutes INT,
	 * 8 OUT return_status TEXT
	 */
	private static final String SP_ADD_LOBBY_POST_FROM_WEBSITE =
			"{call sp_add_lobby_post_from_website(?, ?, ?, ?, ?, ?, ?, ?)}";
	
	/**
	 * 1 raw_dump_type_name VARCHAR(64)
	 * 2 time_fetched INT
	 * 3 dump_value TEXT
	 */
	private static final String SP_ADD_DUMP =
			"{call sp_add_dump(?, ?, ?)}";
	
	/**
	 * 1 comment_id BIGINT
	 * 2 lobby_id BIGINT
	 * 3 display_name VARCHAR(64)
	 * 4 post_date INT
	 * 5 profile_id BIGINT
	 * 6 title TEXT
	 */
	private static final String SP_ADD_LOBBY_POST_FROM_STEAM =
			"{call sp_add_lobby_post_from_steam(?, ?, ?, ?, ?, ?)}";
	
	private static final String SQL_CONNECTION_STRING = 
			"jdbc:mysql://localhost/csgo_derank?user=csgo_derank&password=This!isIguessAP@ssWORD";

	private static Connection connection;
	
	public static String spAddLobbyPostFromWebsite(SpAddLobbyPostFromWebsite lobbyPost) {
		Connection conn = getConnection();
		if (conn == null) {
			return Boot.log("Couldn't connect to the database.");
		}
		try {
			CallableStatement stmt = conn.prepareCall(SP_ADD_LOBBY_POST_FROM_WEBSITE);
			stmt.setLong(1, lobbyPost.lobbyId);
			stmt.setString(2, lobbyPost.displayName);
			stmt.setInt(3, lobbyPost.postDate);
			stmt.setLong(4, lobbyPost.profileId);
			stmt.setString(5, lobbyPost.title);
			stmt.setString(6, lobbyPost.ip);
			stmt.setInt(7, lobbyPost.lobbyIpMinutes);
			stmt.registerOutParameter(8, Types.VARCHAR);
			stmt.execute();
			return stmt.getString(8).trim();
		} catch (SQLException e) {
			return Boot.handleException(
					e, "An internal error occured when trying to add a lobby post.");
		}
	}
	
	/**
	 * 
	 * @param dumpTypeName
	 * @param timefetched Unix timestamp (seconds)
	 * @param dumpText
	 */
	public static void spAddDump(String dumpTypeName, int timefetched, String dumpText) {
		Connection conn = getConnection();
		if (conn == null) {
			Boot.log("Couldn't connect to the database.");
			return;
		}
		try {
			CallableStatement stmt = conn.prepareCall(SP_ADD_DUMP);
			stmt.setString(1, dumpTypeName);
			stmt.setInt(2, timefetched);
			stmt.setString(3, dumpText);
			stmt.execute();
		} catch (SQLException e) {
			Boot.handleException(e, null);
		}
	}
	
	public static void spAddLobbyPostFromSteam_Batch(List<SpAddLobbyPostFromSteam> lobbyPosts) {
		Connection conn = getConnection();
		if (conn == null) {
			Boot.log("Couldn't connect to the database.");
			return;
		}
		try {
			CallableStatement stmt = conn.prepareCall(SP_ADD_LOBBY_POST_FROM_STEAM);
			for (SpAddLobbyPostFromSteam lobbyPost : lobbyPosts) {
				stmt.setLong(1, lobbyPost.commentId);
				stmt.setLong(2, lobbyPost.lobbyId);
				stmt.setString(3, lobbyPost.displayName);
				stmt.setInt(4, lobbyPost.postDate);
				stmt.setLong(5, lobbyPost.profileId);
				stmt.setString(6, lobbyPost.title);
				stmt.addBatch();
			}
			stmt.executeBatch();
		} catch (SQLException e) {
			Boot.handleException(e, null);
		}
	}
	
	@Nullable
	private static Connection getConnection() {
		if (connection == null) {
			try {
				connection = DriverManager.getConnection(SQL_CONNECTION_STRING);
			} catch (SQLException e) {
				Boot.handleException(e, null);
				return null;
			}
		}
		return connection;
	}
}
