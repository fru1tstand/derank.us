<?php
namespace derankus\html\content;
require_once PHP_ROOT . '/derankus/Setup.php';
use common\base\Http;
use derankus\database\Analytics;
use derankus\database\Queries;

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
