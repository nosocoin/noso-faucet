<?php

use Dotenv\Dotenv;

include dirname(__DIR__).'/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__).'/config');
$dotenv->load();

require __DIR__ . '/../src/routes.php';

?>
