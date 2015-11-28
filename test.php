<?php
include ".site/php/csgoderank/html/template/Main.php";
use csgoderank\html\template\Main;

$res = [];
for ($i = 0; $i < 40; $i++) {
	$res[$i] = microtime(true);
	Main::benchmark();
	$res[$i] = microtime(true) - $res[$i];
}

var_dump($res);
