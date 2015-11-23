<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/.site/php/csgoderank/Setup.php';
use common\base\OutputBuffering;
use common\template\TemplateUtils;

//We do this so that page scripts have an opportunity to send headers
OutputBuffering::start();

TemplateUtils::renderContentFromUrl(
		$_SERVER['DOCUMENT_ROOT'] . "/.site/php/csgoderank/html/content",
		"/index.php");

OutputBuffering::flush();
