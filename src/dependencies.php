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

	$container['cookies'] = function($c){
		$request = $c->get('request');
		$request = $request->getCookieParams();
		return $request;
	  };
	

	$container['db'] = function($c) {
		$Base = "mysql:host=$settings[host];dbname=$settings[database]";
		try {
			return new PDO($Base,  $settings['username'], $settings['password']);
		} catch (PDOException $e) {
			throw new PDOException($e->getMessage(), (int)$e->getCode());
		}
	};

	$container['UserAuthInfo'] = function($c) {
		$cookieWallet = !empty($_COOKIE['wallet']) ?  htmlspecialchars($_COOKIE['wallet'], ENT_QUOTES) : '';
		$cookieId = !empty($_COOKIE['id']) ?  htmlspecialchars($_COOKIE['id'], ENT_QUOTES) : '';

		$UserInforSQL = $container->get('db')->prepare("SELECT * FROM `users` WHERE `wallet` = :wallet");
		$UserInforSQL->execute(array('wallet' => $this->cookieWallet));
		if(md5($array['id']) == $array = $UserInforSQL->fetch(\PDO::FETCH_ASSOC)){
		return $array; }
		else{
			unset($UserInforSQL);
		}

	};

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
	
	
	
	