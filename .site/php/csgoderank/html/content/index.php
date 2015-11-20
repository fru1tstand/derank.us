<?php
namespace csgoderank\html\content;
use common\template\ContentPageBuilder;
use csgoderank\html\CsgoDerankTemplate;

$body = <<<HTML
<div class="page-header">
	<h1>CSGO Derank Lobbies</h1>
	<p class="hint">Powered by Fru1tMe</p>
</div>
<div class="section">
    <h2>Lobbies</h2>
</div>
<div class="card-list">
	<div class="card">
		<div class="title">[No Description]</div>
		<div class="host">CLOUD</div>
		<input class="lobby-link" type="text" value="steam://joinlobby/131232123123123123312132/132132132132132123132" />
		<a href="#" class="button button-join"></a>
		<a href="#" class="button button-full"></a>
	</div>
	<div class="card">
		<div class="title">Slimy Seal Leopard</div>
		<div class="host">CLOUD</div>
		<input class="lobby-link" type="text" value="steam://joinlobby/131232123123123123312132/132132132132132123132" />
		<a href="#" class="button button-join"></a>
		<a href="#" class="button button-full"></a>
	</div>

</div>

HTML;


ContentPageBuilder::of(CsgoDerankTemplate::getClass())
	->set(CsgoDerankTemplate::FIELD_TITLE, "Home")
	->set(CsgoDerankTemplate::FIELD_BODY, $body)
	->register();
