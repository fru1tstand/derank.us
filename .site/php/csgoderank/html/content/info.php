<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/.site/php/csgoderank/Setup.php';
use csgoderank\html\template\StaticPage;

$body = <<<HTML
<div class="section">
	<h1>Deranking Tips</h1>
</div>
<div class="container">
	<div class="block-text">
		It's a wall of text. We get it. But for those that are curious...
	</div>
</div>

<div class="section-sm">
	<h3>Does 16-3 actually make a difference?</h3>
</div>
<div class="container">
	<div class="block-text">
		Short answer: Yes.<br />
		Long answer: Omg yes.<br />
		<br />
		Our study [Completed Dec 9, 2015]:
<pre>[0]4,	[0],	[0],	[0],	[0],	[0],	[0],	[0],
[3],	[3],	[3]1 3,	[3],	[3]2,	[3]4,
[0],	[0],	[0],	[0],	[0],	[0],	[0],	[0],
[3],	[3]1,	[3],	[3],	[3]3 5,	[3]1 4,
[0],	[0]2,	[0],	[0],	[0],	[0],	[0],	[0]
Legend: [#rounds won]account # in queue that deranked (if any)
Eg, [3]1 3, means 3 rounds were won and accounts #1 and 3 deranked.

Done over 4 days with no other games played between accounts.
</pre>
		One can see a strong correlation of deranks over games with 3 wins versus games with 0 wins.
		Deranks /can/ occur on games with 0 wins, but are few and far between. Please also consider
		the number of games played (or lack thereof) in drawing conclusions.<br />
		<br />
		Email all angry opinionated arguments and speculation to
		/dev/null<span class="kodleesharenet"></span>.net. Otherwise, please do email me case
		studies that have a significant number of games to
		derankers<span class="kodleesharenet"></span>.net. Finding the optimal deranking strategy
		is our #1 priority, and the more information we get, the better we can do.
	</div>
</div>

<div class="section-sm">
	<h3>How about 16-4/5/6+?</h3>
</div>
<div class="container">
	<div class="block-text">We actually aren't sure. We haven't tested this. If you have any
		evidence pulling one way or another, please contact me.</div>
</div>

<div class="section-sm">
	<h3>Do MVPs, kills, deaths, accuracy, etc matter?</h3>
</div>
<div class="container">
	<div class="block-text">
		Not really. Top fragging or bottom fragging, we didn't see a significant increase or
		decrease in derank rate.
	</div>
</div>

<div class="section-sm">
	<h3>Does surrendering count as {2, 3, ... n} losses?</h3>
</div>
<div class="container">
	<div class="block-text">
		We don't know.
	</div>
</div>

<div class="section-sm">
	<h3>Can I get banned for doing this?</h3>
</div>
<div class="container">
	<div class="block-text">
		While you can't get banned for using our site, you always run the risk of being overwatch
		banned for griefing.<br />
		<br />
		There is a lot of evidence (from several independent 3rd party sources) that conclude that
		you require 6 or more unique reports in-game to be sent to the overwatch queue (this is
		count is cumulative, meaning not all reports have to originate from a single game). From
		there, a verdict will take anywhere from 24 to 48 hours. Yes. Griefing bans do exist. They
		are anywhere from 3 weeks to 2 months. Griefing bans act exactly like VAC bans in which you
		will be unable to connect to any VAC secure servers or trade on the account. However,
		after the ban expires, the account will be able to trade and join games as usual.
	</div>
</div>

<div class="section-sm">
	<h3>How risky is it?</h3>
</div>
<div class="container">
	<div class="block-text">
		In all honesty, we've yet to receive a ban from straight afk deranking. People are more
		likely to be happy that they get a free win versus reporting you for griefing. But the meta
		is subject to change and blah blah blah. Human factors. Remember, you can completely remove
		the risk by acting like you're just trash.
	</div>
</div>


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
		Check out the <a href="/source">Source Code</a> tab to see this website's roadmap
		and changelog events. It's all open source and on Github because programmers unite!
	</div>
</div>

<div class="info-push"></div>
HTML;

StaticPage::createContent()
	->with(StaticPage::FIELD_TITLE, "Info")
	->with(StaticPage::FIELD_BODY, $body)
	->render();
