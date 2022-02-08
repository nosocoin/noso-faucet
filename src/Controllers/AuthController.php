<?php
	
	namespace NosoProject\Controllers;


	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	
	class AuthController extends Controller
	{

       
		
		public function index(Request $request, Response $response)
		{
			return $this->container->view->render($response, 'auth.twig', [
				'Count_Users' => '0',
                'Count_Paid' => '0',
                'Count_Payments' => '0',
			]);
		}
		
	}