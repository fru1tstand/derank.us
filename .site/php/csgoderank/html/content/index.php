<?php
namespace csgoderank\html\content;
require_once $_SERVER['DOCUMENT_ROOT'] . '/.site/php/csgoderank/Setup.php';
use csgoderank\html\template\LobbyCard;
use csgoderank\html\template\StaticPage;

$cardInfo = array(
		array(
				LobbyCard::FIELD_TITLE => null,
				LobbyCard::FIELD_LOBBY_LINK => "steam://joinlobby/131232123123123123312132/132132132132132123132",
				LobbyCard::FIELD_HOST => "CLOUD"
		),
		array(
				LobbyCard::FIELD_TITLE => "Silver 4 max",
				LobbyCard::FIELD_LOBBY_LINK => "steam://joinlobby/131232123123123123312132/132132132132132123132",
				LobbyCard::FIELD_HOST => "CLOUD"
		),

);
$cards = "";
foreach ($cardInfo as $info) {
	$cards .= LobbyCard::createContentFrom($info)->getRenderContents();
}
$body = <<<HTML
<div class="page-header">
	<h1>CSGO Derank Lobbies</h1>
	<p class="hint">Powered by Fru1tMe</p>
</div>
<div class="section">
    <h2>Lobbies</h2>
</div>
<div class="card-list">
	$cards
</div>
HTML;

StaticPage::createContent()
	->with(StaticPage::FIELD_TITLE, "Home")
	->with(StaticPage::FIELD_BODY, $body)
	->render();
