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
	const FIELD_DB_ID = "id";
	const FIELD_LOBBY_ID = "lobby_id";
	const FIELD_DISPLAY_NAME = "display_name";
	const FIELD_POST_DATE = "post_date";
	const FIELD_PROFILE_ID = "profile_id";
	const FIELD_TITLE = "title";

	const DEFAULT_DISPLAY_NAME = "[Unknown]";
	const DEFAULT_TITLE = "[No Description]";


	/**
	 * Produces the complete HTML string for this content page given content fields for this page.
	 *
	 * @param ContentField[] $fields An associative array mapping fields to ContentField objects.
	 * @return string
	 */
	public static function getTemplateRenderContents(array $fields): string {
		return <<<HTML
<tr data-db-id="{$fields[self::FIELD_DB_ID]}">
	<td class="padding"></td>
	<td class="descr">{$fields[self::FIELD_TITLE]}</td>
	<td class="host">{$fields[self::FIELD_DISPLAY_NAME]}</td>
	<td class="age">{$fields[self::FIELD_POST_DATE]}</td>
	<td class="join"><i class="fa fa-external-link-square"></i></td>
	<td class="full"><i class="fa fa-ban"></i></td>
	<td class="hide"><i class="fa fa-times"></i></td>
	<td class="padding"></td>
</tr>
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
	static function getTemplateFields_Internal(): array {
		return [
			TemplateField::newBuilder()
				->called(self::FIELD_DB_ID)
				->asRequired()->build(),
			TemplateField::newBuilder()
				->called(self::FIELD_LOBBY_ID)
				->asRequired()->build(),
			TemplateField::newBuilder()
				->called(self::FIELD_DISPLAY_NAME)
				->asNotRequired()
				->defaultingTo(self::DEFAULT_DISPLAY_NAME)->build(),
			TemplateField::newBuilder()
				->called(self::FIELD_POST_DATE)
				->asRequired()->build(),
			TemplateField::newBuilder()
				->called(self::FIELD_PROFILE_ID)
				->asRequired()->build(),
			TemplateField::newBuilder()
				->called(self::FIELD_TITLE)
				->asNotRequired()
				->defaultingTo(self::DEFAULT_TITLE)->build()
		];
	}

}
