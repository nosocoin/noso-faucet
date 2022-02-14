<?php

	namespace NosoProject\Controllers;
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	use NosoProject\Model\AuthModel;
	use NosoProject\Core\Cookie;

  final class AuthController  {

	protected $container;
	protected $AuthModel;

	public function __construct($container){
		$this->container = $container;
		$this->AuthModel = new AuthModel($container);
	}


	/**
	 * Function for creating cookies!
	 */
	protected function CreateCookie($response){
		$arrayCokies = $this->AuthModel->CookiesArray();
		$response = Cookie::add($response, 'wallet', $arrayCokies['wallet'], 1, 'month');
		$response = Cookie::add($response, 'id', $arrayCokies['id'], 1, 'month');
		$response = Cookie::remove($response, 'ref');
		return $response;
	}


	public function index(Request $request, Response $response){
			return $this->container->view->render($response, 'auth.twig',
			$this->AuthModel->OptionArray(false));
	}
		
	public function login(Request $request, Response $response){
			if($this->AuthModel->routeAuth(Cookie::get($response, 'ref', ''))){
				$response = $this->CreateCookie($response);
				return $response->withStatus(302)->withHeader('Location', '/');
			}else{
				return $this->container->view->render($response, 'auth.twig', 
				$this->AuthModel->OptionArray(true));
			}
	}

	}