<?php
	
	namespace NosoProject\Controllers;

	
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	
	class FaucetController extends Controller
	{
		
		public function index(Request $request, Response $response)
		{
			return $this->container->view->render($response, 'faucet.twig', [
				'title' => 'Home Page'
			]);
		}
		
	}