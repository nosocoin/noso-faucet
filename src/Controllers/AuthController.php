<?php

	namespace NosoProject\Controllers;
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	use NosoProject\Model\AuthModel;

	use Dflydev\FigCookies\Modifier\SameSite;
    use Dflydev\FigCookies\SetCookie;
	use Dflydev\FigCookies\FigResponseCookies;
	use Dflydev\FigCookies\FigRequestCookies;

	use Carbon\Carbon;
	use NosoProject\Core\Cookies;
final class AuthController  {

	protected $container;
	protected $AuthModel;

	public function __construct($container){
		$this->container = $container;
		$this->AuthModel = new AuthModel($container);
	}



	public function index(Request $request, Response $response){


	

		$cookie = FigRequestCookies::get($request,'theme', 'default');
			return $this->container->view->render($response, 'auth.twig',
			 [
				'title' => 'Authorization',
				'wall' => Cookies::get($request, 'name')
			   
			]	);
	}
		
	public function login(Request $request, Response $response){
			if($this->AuthModel->routeAuth()){
			
			
		
				Cookies::add($response, 'name', 'value', 1, 'month');

				return $response->withStatus(302)->withHeader('Location', '/');
			}else{
				return $this->container->view->render($response, 'auth.twig', 
				$this->AuthModel->OptionArray(true));
			}
	}

	}