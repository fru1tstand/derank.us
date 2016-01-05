<?php
namespace derankus\html\content;
require_once PHP_ROOT . '/derankus/Setup.php';
use common\base\Http;
use derankus\feature\HiddenLobby;

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
