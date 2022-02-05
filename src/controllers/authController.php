<?php

namespace NosoProject\controllers;
use NosoProject\views\authView;

class authController{


    private $inputWallet;


    public function __construct(){
        $this->inputWallet = htmlspecialchars($_POST['walletAdress'], ENT_QUOTES);
        $this->routesAuth();
    
    }


    private function routesAuth(){

        if($this->checkWallet()){
            echo $this->inputWallet;
        }else{
            new authView(true);
        }
    }
   




    /**
     * This class implements user authorization,
     * via the authorization form /auth
     */
    private function checkWallet(){
        $check = curl_init('https://explorer.nosocoin.com/api/v1/address/'.$this->inputWallet.'.json');
        curl_setopt($check, CURLOPT_RETURNTRANSFER, true);
        $decode = json_decode(curl_exec($check), true);
        if($decode["code"] == 200 && $decode["message"] == "Ok"){
            return true;
        }else{
            return false;
        }
        curl_close($ch);
    }


}