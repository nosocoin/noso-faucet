<?php

namespace NosoProject\core;

/**
 * An object that checks the availability of view rights depending on authorization
 * (Perhaps the logic here is childish, but it was forced to do it .. someday it will be possible to fix it)
 */
class checkAcces {

    private $userArray;
    private $viewObject;


    public function __construct($userArray,$viewObject,$noAuth=""){
        $this->userArray = $userArray;
        $this->viewObject = $viewObject;

        if($noAuth)
        $this->checkAccesNoAuth();
        else
        $this->checkAccesAuth();
    }


    
    /**
     * The method that initializes the next step when creating an object
     * If the user is authorized, then we will show the view; if not, we will send it for authorization
     * (Verification in favor of an authorized)
     */
    private function checkAccesAuth(){
        if($this->userArray->userId==0)
         $this->redicredAuth();
         else 
         $this->viewObject;
     }
 
 
  
    /**
     * The method that initializes the next step when creating an object
     * (Verification in favor of unauthorized)
     */
    private function checkAccesNoAuth(){
        if($this->userArray->userId==0)
          $this->viewObject;
          else 
          $this->redicredFaucet();
     }
 
     /**
      * Redirect to authorization
      */
     private function redicredAuth(){
         header("Location: /auth");
     }

      /**
      * Redirect to homePage
      */
      private function redicredFaucet(){
        header("Location: /");
    }
 
 
}