<?php

	namespace NosoProject\Controllers;
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;


  final class TestController  {

	protected $container;

	public function __construct($container){
		$this->container = $container;
	}


	/**
	 * 
     *--> 
     *{ "jsonrpc" : "2.0", "method" : "sendfunds", "params" : ["miner5", "1", "test"], "id" : 5 }
     *<--
     *{ "jsonrpc" : "2.0", "result" : [{ "result" : "OR3xqgu9rzhl9mwd58q7p9pj6otc51dj1rbhpa1re27t41b82cbp" }], "id" : 5 }
	 */
	public function loadRPC(){

	/*
        $client = new \GuzzleHttp\Client(['base_uri' => 'http://localhost:8078']);
        $check = $client->request('GET', $this->inputWallet, [
            'headers' => ['Accept' => 'application/json']
        ]);
    return json_decode($check->getBody(), true);*/
	}

	public function index(Request $request, Response $response){
	
			return $this->container->view->render($response, 'test.twig',
			['RPC' => $this->loadRPC()]);
	
	}
		

	}