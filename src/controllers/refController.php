<?php

namespace NosoProject\controllers;

/**
 * The class that receives the ref wallet and creates cookies, 
 * and then redirects to authorization
 */
class refController{

    private $RefWallet;

    public function __construct($RefWallet){
        $this->RefWallet = $RefWallet;
    }

  

    /**
     *  Redirecting to the auth page!
     */
    private function RedicredToAuth(){
        header("Location: /auth");
    }


    public function run(){
        if(!empty($this->RefWallet)){
            setcookie("refer",  $this->RefWallet, time() + 3600, "/");   
        }
       $this->RedicredToAuth();
    }


    
}