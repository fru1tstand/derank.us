<?php
namespace csgoderank\html\content;
require_once $_SERVER['DOCUMENT_ROOT'] . '/.site/php/csgoderank/Setup.php';
use csgoderank\database\Queries;
use csgoderank\html\template\LobbyCard;
use csgoderank\html\template\StaticPage;


$cardContent = LobbyCard::createContentsFromQuery(Queries::getSelectUniqueLobbiesQuery(30));
$cardHtml = "";
foreach ($cardContent as $content) {
	$cardHtml .= $content->getRenderContents();
}

$body = <<<HTML
<div class="page-header">
	<h1>Derank.Us</h1>
	<div class="hint">Find lobbies, get silver.</div>
</div>

<table class="card-list">
	<thead>
		<tr>
			<th class="padding"></th>
			<th>Description</th>
			<th>Host</th>
			<th>Age</th>
			<th></th>
			<th></th>
			<th></th>
			<th class="padding"></th>
		</tr>
	</thead>
	<tbody>
		$cardHtml
	</tbody>
</table>

<iframe id="lobby-linker"></iframe>
<script>
(function() {
	function joinLobby() {
	console.log("asdf");
		var iFrame = document.getElementById('lobby-linker');
		iFrame.src = "/getlink";
	}
	var joins = document.getElementsByClassName('join');
	for (var i = 0; i < joins.length; i++) {
		joins[i].onclick = joinLobby;
	}
} ())
</script>
HTML;

StaticPage::createContent()
	->with(StaticPage::FIELD_TITLE, "Home")
	->with(StaticPage::FIELD_BODY, $body)
	->render();
