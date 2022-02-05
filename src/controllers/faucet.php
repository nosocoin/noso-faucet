<?php

namespace NosoProject\controllers;
use NosoProject\core\userInfo;

class faucet{

    private $userInfo;
    protected $user_ID=0;
    protected $user_WALLET;


    public function __construct(){

        $this->userInfo = new userInfo();
      
    }


    public function checkAcces(){

       if($this->userInfo->userId==0)
        $this->redicredAuth();
        else 
        $this->view();
    }




    protected function redicredAuth(){
        header("Location: /auth");
    }


    protected function view(){
        echo "yes connected";
    }



}

