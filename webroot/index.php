<?php

use Dotenv\Dotenv;

require  __DIR__ .'/../vendor/autoload.php';

// Config for Slim App
$config = require_once __DIR__ . '/../src/config.php';

//Start ENV
$dotenv = Dotenv::createImmutable(dirname(__DIR__).'/config');
$dotenv->load();

//Check empty env
$dotenv->required(['NOSO_PAY','CLAIM_TIME','MIN_NOSO_PAYMENTS','PERCENT_REF'])->notEmpty();

// Slim App instance
$app = new \Slim\App($config);

// Dependencies 
require_once __DIR__ . '/../src/dependencies.php';

// Routes
require_once __DIR__ . '/../src/route.php';

function asset($path) {
    if ($path[0] != '/') {
        $path = "/{$path}";
    }
    return "{$_ENV['APP_URL']}{$path}";
}
$asset = new Twig\TwigFunction('asset', function ($path) {
	return asset($path);
});
$container->get('view')->getEnvironment()->addFunction($asset);

// Run app
$app->run();





