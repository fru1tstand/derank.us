<?php
namespace derankus\html\content;
require_once PHP_ROOT . '/derankus/Setup.php';
use derankus\html\template\StaticPage;

$body = <<<HTML
<div class="section">
	<h1>About Derank.Us</h1>
</div>

<div class="section-sm">
	<h3>Wtf. You're the scum of the csgo community. Why do you do this?</h3>
</div>
<div class="container">
	<div class="block-text">
		Because [insert something about feeling insecure about myself throughout my childhood and
		how I resorted to being the school bully because I was abused as a child and now I need to
		vent my frustrations about never being told I was good enough to my parents and this
		community is the only nonviolent alternative; while without making this a run-on sentence,
		touch on the topic that if you feel otherwise, you're advocating for terrorism because
		instead of counter strike, I would join some extremist religious organization that gets
		funding through government bodies which are meant to product us, but instead do us more
		harm].
	</div>
</div>

<div class="section-sm">
	<h3>No, but seriously, why'd you make this site?</h3>
</div>
<div class="container">
	<div class="block-text">
		Steamcommunity takes like 30 years to load and I got fed up, so I made this thing that
		loads in seconds. Also, more obscurity (no need to be a part of steam groups) and more
		options to control your lobby when you post it (soon^tm).
	</div>
</div>

<div class="section-sm">
	<h3>How do it work?</h3>
</div>
<div class="container">
	<div class="block-text">
		We have some dude locked up in a small room that watches a whole bunch of websites that have
		lobby links (including some steam pages), and then writes some HTML to display it on our
		website. He also takes care of removing them after like 10 minutes. Oh and when you click
		"hide" he gets poked with a stick that has a stickynote at the end of it telling him which
		computer to stop sending a specific lobby to. It's all pretty straightforward.
	</div>
</div>

<div class="section-sm">
	<h3>Why green?</h3>
</div>
<div class="container">
	<div class="block-text">
		Because we're filthy hipsters here. Have you seen any other sites that are green-themed?
		Yeah. That's what I thought. Zero. But we also don't hate. Here are all the primary colors
		just for you:<br />
		<div class="block red"></div>
		<div class="block green"></div>
		<div class="block blue"></div>
	</div>
</div>

<div class="section-sm">
	<h3>How to use this site</h3>
</div>
<div class="container">
	<div class="block-text">
		Seriously? It's not easy enough? Click on the description or, you know, that button that
		says "JOIN"? Alternatively, if you don't like someone or a certain lobby, you can "hide" it
		from view.
	</div>
</div>

<div class="section-sm">
	<h3>Roadmap</h3>
</div>
<div class="container">
	<div class="block-text">
		Check out the
		<a href="https://github.com/fru1tstand/csderankme-website/issues" target="_blank">github issue tracker</a>
		to see this website's roadmap and changelog events. It's all open source because reasons.
	</div>
</div>

<div class="info-push"></div>
HTML;

StaticPage::createContent()
	->with(StaticPage::FIELD_TITLE, "About")
	->with(StaticPage::FIELD_BODY, $body)
	->render();
