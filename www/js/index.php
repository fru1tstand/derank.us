<?php

$indexJsFiles = [
		"/.site/js/lobby-linker.js",
];

header("Content-Type: application/javascript");
foreach ($indexJsFiles as $file) {
	echo file_get_contents($_SERVER['DOCUMENT_ROOT'] . $file);
}
