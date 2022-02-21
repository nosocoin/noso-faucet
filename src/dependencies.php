<?php

use NosoProject\Core\Cookie;

$container = $app->getContainer();

/**
 * Error processing
 */

$container['notAllowedHandler'] = function ($container) {
	return function ($request, $response) use ($container) {
		return $container->view->render($response, '404.twig');
	};
};

$container['notFoundHandler'] = function ($container) {
	return function ($request, $response) use ($container) {
		return $container->view->render($response, '404.twig');
	};
};


$container['view'] = function ($container) {
	$view = new \Slim\Views\Twig(__DIR__ . '/../templates', [
		'cache' => false,
	]);
	$view->addExtension(new \Slim\Views\TwigExtension(
		$container->router,
		$container->request->getUri()
	));

	return $view;
};


$container['POST'] = function ($container) {
	return $container->request->getParsedBody();
};

$container['db'] = function ($container) {
	$settings = $container->get('settings')['db'];
	$host = $settings['Host'];
	$database = $settings['Database'];
	$username = $settings['Username'];
	$password = $settings['Password'];

	$Base = "mysql:host=$host;dbname=$database";
	try {
		return new PDO($Base, $username, $password);
	} catch (PDOException $e) {
		throw new PDOException($e->getMessage(), (int)$e->getCode());
	}
};

/**
 * Request an array of user data if he is authorized
 */
$container['UserAuthInfo'] = function ($container) {

	$cookieWallet = Cookie::get($container->get('request'), 'wallet', '');
	$cookieId =  Cookie::get($container->get('request'), 'id', '');

	$UserInforSQL = $container->get('db')->prepare("SELECT * FROM `users` WHERE `wallet` = :wallet");
	$UserInforSQL->execute(array('wallet' => $cookieWallet));

	return $array = $UserInforSQL->fetch(\PDO::FETCH_ASSOC) and md5($array['id']) == $cookieId ? $array : false;
};





function asset($path)
{
	if ($path[0] != '/') {
		$path = "/{$path}";
	}
	return "{$path}";
}
$asset = new Twig\TwigFunction('asset', function ($path) {
	return asset($path);
});
$container->get('view')->getEnvironment()->addFunction($asset);





// Controllers 
$container['FaucetController'] = function ($container) {
	return new \NosoProject\Controllers\FaucetController($container);
};

$container['AuthController'] = function ($container) {
	return new \NosoProject\Controllers\AuthController($container);
};

$container['PaymentsController'] = function ($container) {
	return new \NosoProject\Controllers\PaymentsController($container);
};

$container['RefLinkController'] = function () {
	return new \NosoProject\Controllers\RefLinkController();
};

$container['ClaimController'] = function ($container) {
	return new \NosoProject\Controllers\ClaimController($container);
};
