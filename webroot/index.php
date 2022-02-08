<?php



require  __DIR__ .'/../vendor/autoload.php';

// Config for Slim App
$config = require_once __DIR__ . '/../src/config.php';

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





