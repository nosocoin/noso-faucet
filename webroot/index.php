<?php
use Dotenv\Dotenv;

//Autoload
include dirname(__DIR__).'/vendor/autoload.php';

//Start ENV
$dotenv = Dotenv::createImmutable(dirname(__DIR__).'/config');
$dotenv->load();

//Enable routing
require __DIR__ . '/../src/routes.php';

?>
