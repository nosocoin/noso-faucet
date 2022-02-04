<?php

namespace NosoProject\controllers;

class faucet{

    protected $user_ID=0;
    protected $user_WALLET;


    public function __construct(){

    }


    public function checkAcces(){

        if($this->user_ID==0)
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

