<?php
use Dotenv\Dotenv;

//Autoload
include dirname(__DIR__).'/vendor/autoload.php';

//Start ENV
$dotenv = Dotenv::createImmutable(dirname(__DIR__).'/config');
$dotenv->load();

//Check empty env
$dotenv->required(['NOSO_PAY','CLAIM_TIME','MIN_NOSO_PAYMENTS','PERCENT_REF'])->notEmpty();


//Enable routing
require __DIR__ . '/../src/routes.php';

?>
