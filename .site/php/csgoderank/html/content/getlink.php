<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/.site/php/csgoderank/Setup.php';
use common\base\Http;
use csgoderank\database\Analytics;
use csgoderank\database\Queries;

define("LOBBY_ID_PARAM", "lobbyid");

$lobbyId = Http::getGetParamValue(LOBBY_ID_PARAM);
if ($lobbyId == null) {
	exit;
}

$lobbyIdAsInt = intval($lobbyId, 10);
if ($lobbyIdAsInt == 0) {
	exit;
}

$id = Queries::selectLobbyIdFromDbId($lobbyIdAsInt);
if ($id == null) {
	exit;
}

Analytics::insertGetlinkAnalytic($lobbyIdAsInt);
header("Location: steam://joinlobby/730/$id");
