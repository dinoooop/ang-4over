<?php

require_once 'env.php';

if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

require_once 'inc/Record.php';
require_once 'inc/Fourover.php';
require_once 'inc/Temp.php';
require_once 'inc/TestCtrl.php';

$main = new Fourover();
$html = new Temp();

$main->set_dates();