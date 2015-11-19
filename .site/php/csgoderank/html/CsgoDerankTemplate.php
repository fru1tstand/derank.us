<?php
namespace csgoderank\html;
use common\template\TemplateInterface;

require_once $_SERVER['DOCUMENT_ROOT'] . '/.site/php/csgoderank/Setup.php';

/**
 * Class CSGO Derank template
 */
class CsgoDerankTemplate implements TemplateInterface {
	const FIELD_BODY = "body";
	const FIELD_TITLE = "title";

	public static function getFields() {
		return [self::FIELD_BODY, self::FIELD_TITLE];
	}

	public static function getClass() {
		return 'fru1tme\html\Fru1tMeTemplate';
	}

	public static function getRenderContents($fields) {
		return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
	<title>CSGO Derank</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="https://s3.amazonaws.com/ks_web/fru1t.me/favicon.ico" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Raleway:400,600'>
	<link rel="stylesheet" href="/.site/styles/compiled/global.css" />
</head>

<body>
	<nav>
		<form>
			<!-- Static and scrolled banner -->
			<input type="radio" class="controller" name="nav-state" id="nav-state-closed" checked="checked" />
			<label for="nav-state-index" class="nav-banner" id="nav-closed-banner">{$fields[CsgoDerankTemplate::FIELD_TITLE]}</label>
			<label for="nav-state-closed" class="nav-banner" id="nav-open-banner">{$fields[CsgoDerankTemplate::FIELD_TITLE]}</label>

			<input type="radio" class="controller" name="nav-state" id="nav-state-index" />
			<ul>
				<li><a href="/">Home</a></li>
				<li><a href="/resume">Résumé</a></li>
				<li><a href="/projects">Projects</a></li>
				<li><a href="/code">Code</a></li>
				<li class="nav-close"><label for="nav-state-closed"></label></li>
			</ul>
		</form>
	</nav>

	<div id="global-content">{$fields[CsgoDerankTemplate::FIELD_BODY]}</div>

	<script src="/.site/js/goog_analytics.js"></script>
</body>
</html>
HTML;
	}
}
