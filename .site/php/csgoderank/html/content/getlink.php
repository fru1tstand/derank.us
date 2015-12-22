<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/.site/php/csgoderank/Setup.php';
use common\base\Http;

define("LOBBY_ID_PARAM", "lobbyid");

$lobbyId = Http::getPostParamValue(LOBBY_ID_PARAM);
if ($lobbyId == null) {
	exit;
}


header('Location: steam://joinlobby/730/109775242595228101/76561198147978524');
