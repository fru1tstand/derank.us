<?php
namespace csgoderank\html\template;
require_once $_SERVER['DOCUMENT_ROOT'] . '/.site/php/csgoderank/Setup.php';
use common\template\component\ContentField;
use common\template\component\TemplateField;
use common\template\Content;

/**
 * Class LobbyCard
 */
class LobbyCard extends Content {
	const FIELD_TITLE = "title";
	const FIELD_HOST = "host";
	const FIELD_LOBBY_LINK = "lobby-link";
	const FIELD_TITLE_DEFAULT = "[No Description]";


	/**
	 * Produces the complete HTML string for this content page given content fields for this page.
	 *
	 * @param ContentField[] $fields An associative array mapping fields to ContentField objects.
	 * @return string
	 */
	public static function getRenderContent(array $fields): string {
		return <<<HTML
<div class="card">
	<div class="title">{$fields[self::FIELD_TITLE]}</div>
	<div class="host">{$fields[self::FIELD_HOST]}</div>
	<input class="lobby-link" type="text" value="{$fields[self::FIELD_LOBBY_LINK]}" />
	<a href="#" class="button button-join"></a>
	<a href="#" class="button button-full"></a>
</div>
HTML;
	}

	/**
	 * <p>Use [TemplateName]::getTemplateFields. This is an internal method.
	 * <p>Returns the TemplateField objects associated to this content page. These are the fields
	 * that are used within the template rendering method. This method is wrapped around
	 * Content::getTemplateFields for memoization.
	 *
	 * @return TemplateField[]
	 * @internal
	 */
	public static function getTemplateFields_Internal(): array {
		return [
			TemplateField::newBuilder()
					->called(self::FIELD_HOST)
					->asRequired()->build(),
			TemplateField::newBuilder()
					->called(self::FIELD_LOBBY_LINK)
					->asRequired()->build(),
			TemplateField::newBuilder()
					->called(self::FIELD_TITLE)
					->asNotRequired()
					->defaultingTo(self::FIELD_TITLE_DEFAULT)->build()
		];
	}
}
