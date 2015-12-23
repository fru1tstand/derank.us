<?php
namespace csgoderank\database;
require_once $_SERVER['DOCUMENT_ROOT'] . '/.site/php/csgoderank/Setup.php';
use common\mysql\MySQL;
use common\mysql\QueryBuilder;
use csgoderank\html\template\LobbyCard;

class Queries {

	/**
	 * Fetches the SQL for the "select unique lobbies" query.
	 *
	 * @param int $minutes
	 * @return string
	 */
	public static function getSelectUniqueLobbiesQuery(int $minutes): string {
		LobbyCard::FIELD_DISPLAY_NAME;
		return "
				SELECT
					`unique_lobbies`.`id` AS ". LobbyCard::FIELD_DB_ID .",
					`lobby_id` AS " . LobbyCard::FIELD_LOBBY_ID . ",
					`display_name` AS " . LobbyCard::FIELD_DISPLAY_NAME . ",
					`post_date` AS " . LobbyCard::FIELD_POST_DATE . ",
					`profile_id` AS " . LobbyCard::FIELD_PROFILE_ID . ",
					`title` AS " . LobbyCard::FIELD_TITLE . "
				FROM (
					SELECT MAX(id) AS id
					FROM lobby_post
					WHERE
						(`post_date` + 60 * $minutes) > UNIX_TIMESTAMP()
						AND `lobby_id` <> 0
						AND `profile_id` <> 0
					GROUP BY lobby_id
				) AS unique_lobbies
				INNER JOIN lobby_post ON lobby_post.id = unique_lobbies.id
				ORDER BY post_date DESC";
	}

	/**
	 * Returns the lobby_id associated to the lobby_post.id value.
	 *
	 * @param int $dbId
	 * @return string
	 * @throws \Exception
	 */
	public static function selectLobbyIdFromDbId(int $dbId): string {
		return MySQL::newQueryBuilder()
			->withQuery("SELECT `lobby_id` FROM `lobby_post` WHERE `id` = ?")
			->withParam($dbId, QueryBuilder::PARAM_TYPE_INT)
			->build()
			->getResultValue();
	}
}
