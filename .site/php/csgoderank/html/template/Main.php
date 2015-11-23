<?php
namespace csgoderank\html\template;
require_once $_SERVER['DOCUMENT_ROOT'] . '/.site/php/csgoderank/Setup.php';
use common\template\Template;
use common\template\TemplateIdentifier;

/**
 * CSGO Derank template
 */
class Main extends TemplateIdentifier {
	const FIELD_BODY = "body";
	const FIELD_TITLE = "title";
}

$renderFn = function($fields): string {
	return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
	<title>CSGO Derank</title>
	<meta charset="UTF-8" />

	<link rel="shortcut icon" href="https://s3.amazonaws.com/ks_web/fru1t.me/favicon.ico" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Raleway:400,600'>
	<link rel="stylesheet" href="/.site/styles/compiled/global.css" />
</head>

<body>
	<nav>
		<div class="nav-header">
			CSGO Derank Lobbies
			{$fields[Main::FIELD_TITLE]}
		</div>
		<ul class="nav-main">
			<li><a href="/home">Home</a></li>
			<li><a href="/about">About</a></li>
			<li><a href="/code">Source Code</a></li>
		</ul>
	</nav>

	<div id="global-content">{$fields[Main::FIELD_BODY]}</div>
</body>
</html>
HTML;
};

Template::newBuilder()
	->setId(Main::getId())
	->addField(Main::FIELD_BODY)
	->addField(Main::FIELD_TITLE)
	->setGetRenderContentsFn($renderFn)
	->register();
