<?php
namespace derankus;
require_once PHP_ROOT . "/common/Autoload.php";
use common\Autoload;
use common\mysql\MySQL;
use common\session\Session;

Autoload::setup(PHP_ROOT, false);
MySQL::setup("localhost", "csgo_derank", "This!isIguessAP@ssWORD", "csgo_derank");
Session::setup("fm-csgo");
