<?php
namespace derankus\feature;
require_once PHP_ROOT . '/derankus/Setup.php';

/**
 * Class PostLobby
 */
class PostLobby {
	const PORT = 27020;
	const ADDRESS = '127.0.0.1';
	const MIN_STRING_LENGTH = 50;

	/**
	 * @param string $input
	 * @return string
	 */
	public static function post(string $input): string {
		if (strlen($input) < self::MIN_STRING_LENGTH) {
			return "No valid lobby link found.";
		}

		$lobbyPostInfo = [
				'ip' => $_SERVER['REMOTE_ADDR'],
				'text' => $input
		];

		$requestText = json_encode($lobbyPostInfo) . "\n";

		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		if (!$socket) {
			return "Couldn't connect to the server.";
		}

		$result = socket_connect($socket, self::ADDRESS, self::PORT);
		if (!$result) {
			return "Couldn't connect to the post server.";
		}

		socket_write($socket, $requestText, strlen($requestText));
		$response = "";
		while ($response .= socket_read($socket, 1024)) {
			if (strpos($response, "\n") !== false) {
				break;
			}
		}
		socket_close($socket);
		return trim($response);
	}
}
