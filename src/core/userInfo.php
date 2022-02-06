<?php

namespace NosoProject\core;
use NosoProject\core\sys\DB;

class userInfo{
    
    private $DB;

    //Cookie variable
    private $cookieWallet;
    private $cookieId;

    //User Variable
    public $userId = 0;
    public $userWalllet  = "";
    public $userBalance;
    public $userLastclaim;
    public $userReferals;
    public $userRef;
    public $userRefBalance;
    public $userPaidOut;
    public $userVerKey;

    public function __construct(){
        $this->DB = DB::connectSQL();
        $this->cookieWallet = !empty($_COOKIE['wallet']) ?  htmlspecialchars($_COOKIE['wallet'], ENT_QUOTES) : '';
        $this->cookieId = !empty($_COOKIE['id']) ?  htmlspecialchars($_COOKIE['id'], ENT_QUOTES) : '';
        
        $this->routesMethod();
    }


    /**
     * Search next step
     */
    private function routesMethod(){
        if(!empty($_COOKIE['wallet']) and !empty($_COOKIE['id'])){
            $this->importUserInfo(); 
        }else{
            $this->cleanCookie();
        }
    }
 
    /**
     * A method that, if cookies exist, makes a request to the database and receives data from the authorized user from there
     */
    private function importUserInfo(){

    $userInforSQL =  $this->DB->prepare("SELECT * FROM `users` WHERE `wallet` = :wallet");
    $userInforSQL->execute(array('wallet' => $this->cookieWallet));

    if($array = $userInforSQL->fetch(\PDO::FETCH_ASSOC)){
     if(md5($array['id']) == $this->cookieId){
    $this->userId = $array['id'];
    $this->userWallet = $array['wallet']; 
    $this->userBalance = $array['balance'];
    $this->userLastclaim = $array['lastclaim'];
    $this->userRef = $array['ref'];
    $this->userReferals = $array['referrals'];
    $this->userRefBalance = $array['refBalance'];
    $this->userPaidOut = $array['paidOut'];
    $this->userVerKey = $array['keyClaimVer'];

  }else{ $this->cleanCookie();   }

  }else{ $this->cleanCookie();   }

  }


  /**
   * Force clear cookies
   */
     private function cleanCookie(){
         setcookie("wallet", null, null);
         setcookie("id", null, null);
     }

}