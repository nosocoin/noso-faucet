<?php

namespace NosoProject\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use NosoProject\Model\ClaimModel;
use NosoProject\Methods\CheckAccesClaim;


final class ClaimController
{
	protected $container;
	protected $ClaimModel;
	protected $UserArray;

	public function __construct($container)
	{
		$this->container = $container;
		$this->ClaimModel = new ClaimModel($container);
		$this->UserArray = $this->container->get('UserAuthInfo');
	}


	public function checkClaim(Request $request, Response $response)
	{
		if (
			$this->UserArray and $this->UserArray['keyClaimVer'] == $_POST['TOKEN_HIDEEN'] && !empty($this->UserArray['keyClaimVer'] )
			&& CheckAccesClaim::Run($this->UserArray['lastclaim'])
		) {
			$this->ClaimModel->Run();
			return $response->withStatus(302)->withHeader('Location', '/');
		}
	}



	public function index(Request $request, Response $response, $args)
	{
		if (
			$this->UserArray and $this->UserArray['keyClaimVer'] == $_POST['TOKEN_HIDEEN'] && !empty($this->UserArray['keyClaimVer'] )
			&& CheckAccesClaim::Run($this->UserArray['lastclaim'])
		) {
			return $this->container->view->render($response, 'claim.twig', $this->ClaimModel->OptionArray());
		} else {
			return $response->withStatus(302)->withHeader('Location', $this->UserArray ? '/' : '/auth');
		}
	}
}
