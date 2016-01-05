<?php
namespace derankus\html\content;
require_once PHP_ROOT . '/derankus/Setup.php';
use derankus\database\Queries;
use derankus\html\template\LobbyCard;
use derankus\html\template\StaticPage;


$cardContent = LobbyCard::createContentsFromQuery(Queries::getSelectUniqueLobbiesQuery(10));
$cardHtml = "";
foreach ($cardContent as $content) {
	$cardHtml .= $content->getRenderContents();
}

$body = <<<HTML
<div id="landing-banner">
	<div>
		<h1>Derank.Us</h1>
		<p class="hint">Find Lobbies. Get Silver.</p>
	</div>
</div>

<div class="lobby-spacer"></div>
<div class="lobby-controllers" id="post-lobby-link-container" style="display: none">
	<form action="#">
		<div>
			<input type="text" id="new-lobby-input" placeholder="Post a lobby link and description" />
		</div>
		<div>
			<button class="lobby-controller-link" type="submit">Submit</button>
			<button class="lobby-controller-link" type="reset">Cancel</button>
		</div>
	</form>
</div>
<div class="card-list" id="post-lobby-link-edit">
	<div>
		<div class="age">0</div>
		<div class="title">title</div>
		<div class="button" id="post-lobby-bump">Bump</div>
		<div class="button" id="post-lobby-close">Delete</div>
	</div>
</div>

<div class="lobby-spacer"></div>
<div class="card-list" id="card-list">
	$cardHtml
</div>
<div id="no-lobbies" style="display: none;">No active lobbies found. Consider making one!</div>
<div class="lobby-card-buttons">
	<div class="button" id="reset-hidden-lobbies-button">Reset Hidden Lobbies</div>
</div>

<div class="lobby-spacer"></div>
<iframe class="hidden" id="lobby-linker"></iframe>

<script src="/js/index.php"></script>
HTML;

StaticPage::createContent()
	->with(StaticPage::FIELD_TITLE, "Home")
	->with(StaticPage::FIELD_BODY, $body)
	->render();
