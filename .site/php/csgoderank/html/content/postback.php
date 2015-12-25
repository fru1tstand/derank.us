<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/.site/php/csgoderank/Setup.php';

exit;

$port = 27020;
$address = '127.0.0.1';

$send = \common\base\Http::getPostParamValue("q");
if ($send == null) {
	exit;
}

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if (!$socket) {
	exit;
}

$result = socket_connect($socket, $address, $port);
if (!$result) {
	exit;
}

socket_write($socket, $send, strlen($send));
socket_close($socket);
