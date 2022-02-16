<?php
	
namespace NosoProject\Controllers;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use NosoProject\Model\ClaimModel;
use NosoProject\Methods\CheckAccesClaim;


final class ClaimController {
	protected $container;
	protected $ClaimModel;
	protected $userArray;
		
	public function __construct($container){
		$this->container = $container;
		$this->ClaimModel = new ClaimModel($container);
		$this->userArray = $this->container->get('UserAuthInfo');

	}

	/**
	 * Нужно сделать проверки
	 * 1. Проверка на выход времени и также это нужно продлить на index
	 * 2. Проверка на существоания кода гененрации
	 */

	protected function routerCheck(){
	
	}

	
	public function checkClaim(Request $request, Response $response){
		if($this->userArray and $this->userArray['keyClaimVer'] == $_POST['TOKEN_HIDEEN'] && CheckAccesClaim::Run($this->UserArray['lastclaim'])){
		



	//	return $this->container->view->render($response, 'claim.twig', $this->ClaimModel->OptionArray());
		}else
			return $response->withStatus(302)->withHeader('Location', '/auth');
		}	
	


	public function index(Request $request, Response $response, $args){
	    if($this->userArray and $this->userArray['keyClaimVer'] == $_POST['TOKEN_HIDEEN'] && !empty($_POST['TOKEN_HIDEEN'] )
		   && CheckAccesClaim::Run($this->UserArray['lastclaim'])){
		return $this->container->view->render($response, 'claim.twig', $this->ClaimModel->OptionArray());
			}else {
			return $response->withStatus(302)->withHeader('Location',$this->userArray ? '/' : '/auth');
			}
		}	
	}	