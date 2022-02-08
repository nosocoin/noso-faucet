<?php
	
	$container = $app->getContainer();

	// Register component on container
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
	

	$container['db'] = function($c) {
		$settings = $c->get('settings')['db'];
		$host = $settings['host'];
		$port = $settings['port'];
		$database = $settings['database'];
		$username = $settings['username'];
		$password = $settings['password'];
	
		$dsn = "mysql:host=$host;dbname=$database";
	
		try {
			return new PDO($dsn, $username, $password);
		} catch (PDOException $e) {
			throw new PDOException($e->getMessage(), (int)$e->getCode());
		}
	};

	
	// Controllers 
	$container['FaucetController'] = function ($container) {
		return new \NosoProject\Controllers\FaucetController($container);
	};
	
	
	