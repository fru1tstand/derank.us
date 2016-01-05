<?php
namespace derankus\html\content;
require_once PHP_ROOT . '/derankus/Setup.php';
use derankus\html\template\StaticPage;

$body = <<<HTML
<div class="section">
	<h1>Derank.Us Source</h1>
</div>
<div class="container">
	<div class="block-text">
		Checkout the source on
		<a href="https://github.com/fru1tstand/csderankme-website" target="_blank">Github</a>
		and view our
		<a href="https://github.com/fru1tstand/csderankme-website/issues" target="_blank">roadmap/issue tracker</a>.
	</div>
</div>

<div class="section-sm">
	<h3>Technologies</h3>
</div>
<div class="container">
	<div class="block-text">
		Website: PHP (on apache), HTML, Javascript, Sassy CSS<br />
		Database: MySQL<br />
		Backend services: Java<br />
		<br />
		Libraries:<br />
		<a href="https://github.com/fru1tstand/Fru1tMe-Common-Php" target="_blank">PHP 7 Comms</a>
		(for PHP templating and database interfacing)<br />
		<a href="https://github.com/google/gson" target="_blank">gson</a>
		(for Java JSON support)<br />
		<a href="http://jsoup.org/" target="_blank">jsoup</a>
		(for Java HTML parsing)<br />
		<a href="https://commons.apache.org/proper/commons-io/" target="_blank">Apache Commons IO</a>
		(for Java IO)
	</div>
</div>
HTML;


StaticPage::createContent()
		->with(StaticPage::FIELD_TITLE, "Info")
		->with(StaticPage::FIELD_BODY, $body)
		->render();
