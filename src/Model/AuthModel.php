<?php

namespace NosoProject\Model;
use NosoProject\Core\CoreFunctional;

class AuthModel{
    protected $DB;

    public function __construct($DB){
        $this->DB = $DB;
    }
    
     /**
     * Get the number of users
     */
    public function GetCountUsers(){
		$inquiry = $this->DB->prepare("SELECT * FROM `users`");
		$inquiry->execute();
		return  CoreFunctional::FormatNumber($inquiry->rowCount());
	  }
  
	  /**
	   * Get the number of Paid of NOSO
	   */
	  public function GetCountPaidNoso(){
		$inquiry = $this->DB->prepare("SELECT sum(paidOut) FROM `users` ");
		$inquiry->execute();
		return  CoreFunctional::FormatNumber($inquiry->fetchColumn());
	  }
  
	  /**
	   * Get the number of payments
	   */
	  public function GetCountPayments(){
		$inquiry = $this->DB->prepare("SELECT * FROM `payments` WHERE  `status` ");
		$inquiry->execute(array('ok'));
		return CoreFunctional::FormatNumber($inquiry->rowCount());
	  }


}