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
	
	// Controllers 
	/*
	$container['HomeController'] = function ($container) {
		return new \App\Controllers\HomeController($container);
	};*/
	
	
	