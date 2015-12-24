<?php
namespace csgoderank;
require_once $_SERVER["DOCUMENT_ROOT"] . "/.site/php/common/Autoload.php";
use common\Autoload;
use common\mysql\MySQL;
use common\session\Session;

Autoload::setup($_SERVER["DOCUMENT_ROOT"] . "/.site/php", false);
MySQL::setup("localhost", "csgo_derank", "This!isIguessAP@ssWORD", "csgo_derank");
Session::setup("fm-csgo");
