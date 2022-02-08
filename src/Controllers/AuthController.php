<?php
	
	namespace NosoProject\Controllers;
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	use NosoProject\Core\CoreFunctional;
	
final class AuthController extends Controller {
      
	  /**
     * Get the number of users
     */
    private function GetCountUsers(){
		$inquiry = $this->DB->prepare("SELECT * FROM `users`");
		$inquiry->execute();
		return  CoreFunctional::FormatNumber($inquiry->rowCount());
	  }
  
	  /**
	   * Get the number of Paid of NOSO
	   */
	  private function GetCountPaidNoso(){
		$inquiry = $this->DB->prepare("SELECT sum(paidOut) FROM `users` ");
		$inquiry->execute();
		return  CoreFunctional::FormatNumber($inquiry->fetchColumn());
	  }
  
	  /**
	   * Get the number of payments
	   */
	  private function GetCountPayments(){
		$inquiry = $this->DB->prepare("SELECT * FROM `payments` WHERE  `status` ");
		$inquiry->execute(array('ok'));
		return CoreFunctional::FormatNumber($inquiry->rowCount());
	  }
  

  
		public function index(Request $request, Response $response)
		{
			return $this->container->view->render($response, 'auth.twig', [
				'title' => 'Authorization',
				'Count_Users' => $this->getCountUsers(),
                'Count_Paid' => $this->GetCountPaidNoso(),
                'Count_Payments' => $this->GetCountPayments(),
			]);
		}
		
	}