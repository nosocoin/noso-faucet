<?php
defined('pasichDev') or die('Access is denied');

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

/**
 * Автозагрузка классов
 */

 spl_autoload_register(function ($class) {
    include 'sys/class/' . $class . '.class.php';
});


$core = new core() or die('Error: Core System'); //загрузим ядро
new userInfo() or die('Error: Core System'); 
unset($core);

$user_id = userInfo::$user_ID;
$user_wallet = userInfo::$user_WALLET;


