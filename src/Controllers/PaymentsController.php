<?php
	
	namespace NosoProject\Controllers;
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	use NosoProject\Model\PaymentsModel;

	final class PaymentsController {
		protected $container;
		
		public function __construct($container){
			$this->container = $container;
			$this->PaymentsModel = new PaymentsModel($container->get('db'));
		}
	

		public function index(Request $request, Response $response){
			return $this->container->view->render($response, 'payments.twig', [
				'title' => 'Payments'
			]);
		}
		
	}