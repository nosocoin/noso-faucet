<?php
	
	$container = $app->getContainer();

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
		$settings = $c->get('settings')['db'];
		$host = $settings['host'];
		$port = $settings['port'];
		$database = $settings['database'];
		$username = $settings['username'];
		$password = $settings['password'];
	
		$Base = "mysql:host=$host;dbname=$database";
		try {
			return new PDO($Base, $username, $password);
		} catch (PDOException $e) {
			throw new PDOException($e->getMessage(), (int)$e->getCode());
		}
	};

	$container['UserAuthInfo'] = function($container) {
		$cookieWallet = !empty($_COOKIE['wallet']) ?  htmlspecialchars($_COOKIE['wallet'], ENT_QUOTES) : '';
		$cookieId = !empty($_COOKIE['id']) ?  htmlspecialchars($_COOKIE['id'], ENT_QUOTES) : '';

		$UserInforSQL = $container->get('db')->prepare("SELECT * FROM `users` WHERE `wallet` = :wallet");
		$UserInforSQL->execute(array('wallet' => $cookieWallet));
		if($array = $UserInforSQL->fetch(\PDO::FETCH_ASSOC) and md5($array['id']) == $cookieId ){
		return $array; 
	    } else{
			unset($UserInforSQL);
			return false;
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

	$container['RefLinkController'] = function () {
		return new \NosoProject\Controllers\RefLinkController();
	};
	
	
	
	