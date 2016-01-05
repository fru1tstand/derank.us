<?php
namespace derankus\html\content;
require_once PHP_ROOT . '/derankus/Setup.php';
use derankus\html\template\StaticPage;

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
	<h3>4-man lobbies vs 5</h3>
</div>
<div class="container">
	<div class="block-text">
		With 4 man, you potentially have the opportunity to get a slightly faster game, but your
		mileage may vary. You're also subject to a higher risk of overwatch ban (see below).
		From our experience, it's easier just to go with a 5 man because not only are derankers
		plentiful, but you also won't be ruining a poor chap's day.
	</div>
</div>

<div class="section-sm">
	<h3>Does surrendering count as {2, 3, ... n} losses?</h3>
</div>
<div class="container">
	<div class="block-text">
		We don't know. From what we've seen, no. It makes no sense logically either (however, Valve
		has proven time and time again, logic isn't a requirement to push updates).
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
		In all honesty, we've yet to receive a ban on any of our accounts from straight
		afk deranking. People are more likely to be happy that they get a free win versus reporting
		you for griefing (depending on how you play your cards). But the meta is subject to change
		and blah blah blah. Human factors. Risk? Low. But it does happen.
	</div>
</div>

<div class="info-push"></div>
HTML;

StaticPage::createContent()
		->with(StaticPage::FIELD_TITLE, "Tips")
		->with(StaticPage::FIELD_BODY, $body)
		->render();
