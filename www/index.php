<?php
define('PHP_ROOT', $_SERVER['DOCUMENT_ROOT'] . "/../php", true);
require_once PHP_ROOT . '/derankus/Setup.php';
use common\template\TemplateUtils;
use derankus\database\Analytics;

TemplateUtils::renderContentFromUrl(
		PHP_ROOT . "/derankus/html/content",
		"/index.php");

Analytics::insertPageloadAnalytic();
