<?php
namespace csgoderank;
use common\base\Autoload;
use common\mysql\MySQL;

require_once $_SERVER["DOCUMENT_ROOT"] . "/.site/php/common/base/Autoload.php";
Autoload::setup($_SERVER["DOCUMENT_ROOT"] . "/.site/php", false);
MySQL::setup("localhost", "csgo_derank", "This!isIguessAP@ssWORD", "csgo_derank");
