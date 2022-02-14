<?php

namespace NosoProject\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Dflydev\FigCookies\SetCookie;
use Dflydev\FigCookies\FigResponseCookies;
use Dflydev\FigCookies\FigRequestCookies;
use Dflydev\FigCookies\Cookie;

final class TestController {

	protected $container;


	public function __construct($container){
		$this->container = $container;
	
	}


    public function index(Request $request, Response $response){

        $cookies = \Dflydev\FigCookies\Cookies::fromRequest($request);
        $response = FigResponseCookies::set($response, SetCookie::create('token')
        ->withValue('xxxxToken')
        ->rememberForever()
);


        return $this->container->view->render($response, 'test.twig', [
         'test' => FigRequestCookies::get($request, 'token')]);
    }
}