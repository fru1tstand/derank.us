<?php
namespace derankus\html\template;
require_once PHP_ROOT . '/derankus/Setup.php';
use common\template\component\ContentField;
use common\template\component\TemplateField;
use common\template\Content;
use derankus\feature\HiddenLobby;

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
		$time = round((time() - $fields[self::FIELD_POST_DATE]->getContent()) / 60);
		$title = htmlentities($fields[self::FIELD_TITLE]);
		$displayName = htmlentities($fields[self::FIELD_DISPLAY_NAME]);
		$timeoutTime = HiddenLobby::TIMEOUT_MINUTES;
		return <<<HTML
<div data-db-id="{$fields[self::FIELD_DB_ID]}">
	<div class="age" title="Posted {$time} minute(s) ago">{$time}</div>
	<div class="title button">{$title}</div>
	<div class="host" title="Posted by {$displayName}">{$displayName}</div>
	<div class="join button" title="Join lobby"></div>
	<div class="hide button" title="Hide lobby for the next $timeoutTime minutes"></div>
</div>
HTML;
	}
	// <div class="full" title="Mark lobby as full or broken"></div>

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
