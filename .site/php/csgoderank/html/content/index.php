<?php
namespace csgoderank\html\content;
use common\template\ContentPageBuilder;
use csgoderank\html\CsgoDerankTemplate;

$body = <<<HTML
Hi csgo
HTML;


ContentPageBuilder::of(CsgoDerankTemplate::getClass())
	->set(CsgoDerankTemplate::FIELD_TITLE, "Home")
	->set(CsgoDerankTemplate::FIELD_BODY, $body)
	->register();
