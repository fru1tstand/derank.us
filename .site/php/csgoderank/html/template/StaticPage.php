<?php
namespace csgoderank\html\template;
require_once $_SERVER['DOCUMENT_ROOT'] . '/.site/php/csgoderank/Setup.php';
use common\template\component\ContentField;
use common\template\component\TemplateField;
use common\template\Content;

/**
 * CSGO Derank template
 */
class StaticPage extends Content {
	const FIELD_BODY = "body";
	const FIELD_TITLE = "title";

	/**
	 * Produces the complete HTML string for this content page given content fields for this page.
	 *
	 * @param ContentField[] $fields An associative array mapping fields to ContentField objects.
	 * @return string
	 */
	public static function getTemplateRenderContents(array $fields): string {
		return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Derank.Us {$fields[self::FIELD_TITLE]}</title>
	<meta charset="UTF-8" />

	<!--<link rel="shortcut icon" href="https://s3.amazonaws.com/ks_web/fru1t.me/favicon.ico" />-->
	<!--<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Raleway:400,600'>-->
	<link rel="stylesheet" href="/.site/styles/cache/raleway.css" />
	<link rel="stylesheet" href="/.site/styles/compiled/global.css" />
</head>

<body>
	<div id="content-wrapper">
		<nav>
			<ul class="nav-main">
				<li><a href="/home" class="logo">Derank.Us</a></li>
				<li><a href="/home">Home</a></li>
				<li><a href="/tips">Tips</a></li>
				<li><a href="/about">About</a></li>
				<li><a href="/source">Source Code</a></li>
			</ul>
		</nav>

		<div id="global-content">{$fields[self::FIELD_BODY]}</div>
		<div id="content-push"></div>
	</div>
	<footer>
		<a href="/">Derank.Us</a> powered by <a href="http://fru1t.me" target="_blank">Fru1t.Me</a>
		<div class="right">Made with love, By Kodlee Yin.</div>
	</footer>

	<!--<script src="/.site/js/analytics.js"></script>-->
</body>
</html>
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
				TemplateField::newBuilder()->called(self::FIELD_BODY)->asRequired()->build(),
				TemplateField::newBuilder()->called(self::FIELD_TITLE)->asRequired()->build()
		];
	}
}
