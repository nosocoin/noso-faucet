<?php

	namespace NosoProject\Controllers;
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	use NosoProject\Model\AuthModel;

	
final class AuthController  {

	protected $container;
	protected $AuthModel;

 
	public function __construct($container){
		$this->container = $container;
		$this->AuthModel = new AuthModel($container->get('db'));
	
	}

  
	public function index(Request $request, Response $response){
			return $this->container->view->render($response, 'auth.twig',
			$this->AuthModel->OptionArray(false));
		}
		

		public function login(Request $request, Response $response){
			if($this->AuthModel->routeAuth()){
				return $response->withStatus(302)->withHeader('Location', '/');
			}else{
				return $this->container->view->render($response, 'auth.twig', 
				$this->AuthModel->OptionArray(true));
			}
		}
	}