<?php

	namespace NosoProject\Controllers;
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	use NosoProject\Model\AuthModel;

	//N4ZR3fKhTUod34evnEcDQX3i6XufBDU
	
final class AuthController  {

	protected $container;
	protected $AuthModel;
 
	public function __construct($container){
		$this->container = $container;
		$this->AuthModel = new AuthModel($container->get('db'));	
	}

  
	public function index(Request $request, Response $response){
			return $this->container->view->render($response, 'auth.twig', [
				'title' => 'Authorization',
				'Count_Users' => $this->AuthModel->getCountUsers(),
                'Count_Paid' => $this->AuthModel->GetCountPaidNoso(),
                'Count_Payments' => $this->AuthModel->GetCountPayments(),
				'ErrorInvalidWallet' => false
			]);
		}
		

		public function login(Request $request, Response $response){
			return $this->container->view->render($response, 'auth.twig', [
				'title' => 'Authorization',
				'Count_Users' => $this->AuthModel->getCountUsers(),
                'Count_Paid' => $this->AuthModel->GetCountPaidNoso(),
                'Count_Payments' => $this->AuthModel->GetCountPayments(),
				'ErrorInvalidWallet' => true
			]);
		}
	}