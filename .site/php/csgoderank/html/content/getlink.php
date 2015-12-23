<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/.site/php/csgoderank/Setup.php';
use common\base\Http;
use csgoderank\database\Queries;

define("LOBBY_ID_PARAM", "lobbyid");

$lobbyId = Http::getGetParamValue(LOBBY_ID_PARAM);
if ($lobbyId == null) {
	exit;
}

$id = Queries::selectLobbyIdFromDbId($lobbyId);
header("Location: steam://joinlobby/730/$id");

?>
<!--<script>-->
<!--	window.parent.thing();-->
<!--</script>-->
