<?php

use Dotenv\Dotenv;

//Start ENV
$dotenv = Dotenv::createImmutable(dirname(__DIR__).'/config');
$dotenv->load();

//Check empty env
$dotenv->required(['NOSO_PAY','CLAIM_TIME','MIN_NOSO_PAYMENTS','PERCENT_REF'])->notEmpty();

return ['settings' => [
    'addContentLengthHeader' => false,
    'displayErrorDetails' => true,

    'db' => [
        'host' => $_ENV['FAUCET_DATABASE_HOST'],
        'database' => $_ENV['FAUCET_DATABASE'],
        'username' => $_ENV['FAUCET_DATABASE_USER'],
        'password' => $_ENV['FAUCET_DATABASE_PASSWORD'],
    ],
]

];
