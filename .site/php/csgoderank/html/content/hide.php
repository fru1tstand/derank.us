<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/.site/php/csgoderank/Setup.php';
use common\base\Http;
use csgoderank\feature\HiddenLobby;

$lobbyDbId = Http::getGetParamValue("id");

// No id, just exit
if ($lobbyDbId == null) {
	exit;
}

// Reset all lobbies
if ($lobbyDbId == HiddenLobby::RESET_ID) {
	HiddenLobby::reset();
	exit;
}

HiddenLobby::add($lobbyDbId);
