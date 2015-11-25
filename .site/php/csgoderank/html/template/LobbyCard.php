<?php
namespace csgoderank\html\template;
use common\template\Template;
use common\template\TemplateIdentifier;

require_once $_SERVER['DOCUMENT_ROOT'] . '/.site/php/csgoderank/Setup.php';

/**
 * Class LobbyCard
 */
class LobbyCard extends TemplateIdentifier {
	const FIELD_TITLE = "title";
	const FIELD_HOST = "host";
	const FIELD_LOBBY_LINK = "lobby-link";
}

$renderFn = function($fields): string {
	$fields[LobbyCard::FIELD_TITLE] = $fields[LobbyCard::FIELD_TITLE] ?? "[No Description]";

	return <<<HTML
<div class="card">
	<div class="title">{$fields[LobbyCard::FIELD_TITLE]}</div>
	<div class="host">{$fields[LobbyCard::FIELD_HOST]}</div>
	<input class="lobby-link" type="text" value="{$fields[LobbyCard::FIELD_LOBBY_LINK]}" />
	<a href="#" class="button button-join"></a>
	<a href="#" class="button button-full"></a>
</div>
HTML;
};

Template::newBuilder()
	->id(LobbyCard::getId())
	->addField(LobbyCard::FIELD_HOST)
	->addField(LobbyCard::FIELD_LOBBY_LINK)
	->addField(LobbyCard::FIELD_TITLE)
	->setRenderFn($renderFn)
	->register();
