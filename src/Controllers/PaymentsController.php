<?php
	
	namespace NosoProject\Controllers;
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	use NosoProject\Model\PaymentsModel;
	use NosoProject\Core\Cookie;

	
	final class PaymentsController {
		protected $container;
		protected $PaymentsModel;
		
		public function __construct($container){
			$this->container = $container;
			$this->PaymentsModel = new PaymentsModel($container->get('db'));
		}
	

		public function index(Request $request, Response $response){
			if($this->container->get('UserAuthInfo')){

				$response = Cookie::remove($response, 'id');
			
			return $this->container->view->render($response, 'payments.twig', [
				'title' => 'Payments',
				'ViewPayments' => true
			]);
			}else
			return $response->withStatus(302)->withHeader('Location', '/auth');
		}
		
	}	