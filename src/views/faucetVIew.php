<?php

namespace NosoProject\views;
use NosoProject\core\userInfo;

class faucet{

    private $userInfo;
    

    public function __construct(){
        $this->userInfo = new userInfo();
    
        $this->checkAcces();
    }


    private function view(){
        echo "yes connected";
        
    }



}

