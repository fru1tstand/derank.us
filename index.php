<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/.site/php/csgoderank/Setup.php';
use common\template\TemplateUtils;

TemplateUtils::renderContentFromUrl(
		$_SERVER['DOCUMENT_ROOT'] . "/.site/php/csgoderank/html/content",
		"/index.php");
