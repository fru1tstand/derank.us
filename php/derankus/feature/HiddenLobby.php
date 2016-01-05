<?php
namespace derankus\feature;
require_once PHP_ROOT . '/derankus/Setup.php';
use common\base\Preconditions;
use common\session\Session;
use derankus\database\Queries;

/**
 * Class HiddenLobby
 */
class HiddenLobby {
	const SESSION_KEY = "hidden-lobbies";
	const TIMEOUT_MINUTES = 10;
	const RESET_ID = "reset";

	/**
	 * Adds a lobby to be hidden within this session
	 *
	 * @param int $lobbyDbId
	 */
	public static function add(int $lobbyDbId) {
		$lobbyId = Queries::selectLobbyIdFromDbId($lobbyDbId);
		if ($lobbyId == null) {
			return;
		}

		$hiddenLobbies = self::get();
		$hiddenLobbies[$lobbyId] = time() + (self::TIMEOUT_MINUTES * 60);
		Session::set(self::SESSION_KEY, $hiddenLobbies);
	}

	/**
	 * Fetches lobbies marked as hidden within this session as an associative array mapping lobby
	 * id to the time it expires.
	 *
	 * @return string[]
	 */
	public static function get(): array {
		$hiddenLobbies = Session::get(self::SESSION_KEY);
		if (Preconditions::arrayNullOrEmpty($hiddenLobbies)) {
			$hiddenLobbies = [];
		}

		foreach ($hiddenLobbies as $lobby => $time) {
			if ($time < time()) {
				unset($hiddenLobbies[$lobby]);
			}
		}

		Session::set(self::SESSION_KEY, $hiddenLobbies);
		return $hiddenLobbies;
	}

	public static function reset() {
		Session::delete(self::SESSION_KEY);
	}
}
