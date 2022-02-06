<?php

namespace NosoProject\core;

/**
 * An object that checks the availability of view rights depending on authorization
 */
class checkAcces {

    private $userArray;
    private $viewObject;


    public function __construct($userArray,$viewObject){
        $this->userArray = $userArray;
        $this->viewObject = $viewObject;

        $this->checkAcces();
    }


    
    /**
     * The method that initializes the next step when creating an object
     * If the user is authorized, then we will show the view; if not, we will send it for authorization
     */
    private function checkAcces(){
        if($this->userArray->userId==0)
         $this->redicredAuth();
         else 
         $this->viewObject->view();
     }
 
 
 
 
     /**
      * Redirect to authorization
      */
     private function redicredAuth(){
         header("Location: /auth");
     }
 
 
}