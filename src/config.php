<?php

use Dotenv\Dotenv;

//Start ENV
$dotenv = Dotenv::createImmutable(dirname(__DIR__) . '/config');
$dotenv->load();
$dotenv -> safeLoad ();

//Check empty env
$dotenv->required(['FAUCET_DATABASE_HOST', 'FAUCET_DATABASE', 'FAUCET_DATABASE_USER'])->notEmpty();

return [
    'settings' => [
        'addContentLengthHeader' => false,
        'displayErrorDetails' => true,
        'db' => [
            'Host' => $_ENV['FAUCET_DATABASE_HOST'],
            'Database' => $_ENV['FAUCET_DATABASE'],
            'Username' => $_ENV['FAUCET_DATABASE_USER'],
            'Password' => $_ENV['FAUCET_DATABASE_PASSWORD']
        ]
    ]

];
