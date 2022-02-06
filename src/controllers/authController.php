<?php

namespace NosoProject\controllers;
use NosoProject\views\authView;
use NosoProject\core\sys\DB;


class authController{
    
    private $inputWallet;
    private $refer;
    private $DB;

    public function __construct(){
        $this->inputWallet = !empty($_POST['walletAdress']) ?  htmlspecialchars($_POST['walletAdress'], ENT_QUOTES) : '';
        $this->refer = !empty($_COOKIE['refer']) ?  htmlspecialchars($_COOKIE['refer'], ENT_QUOTES) : '';
        $this->DB = DB::connectSQL(); //Connected Mysql

        $this->routesAuth(); //Start next step
    }


    /**
     * The method that determines the next steps! After receiving the wallet address.
     */
    private function routesAuth(){
        if($this->checkWallet()){
          $this->authStart();
          header("Location: /");
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



      /**
     * Method that authorizes the user by wallet address
     * To begin with, we will check whether this address exists in the database
     * -- if the address exists, then we will create a cookie and redirect the user to the main page
     * ---- if the address does not exist, then we will create an entry in the database, and continue authorization
     */
    private function authStart(){

        $idUserConect;

        //Let's make a request whether this user exists
        $connect = $this->DB->prepare("SELECT * FROM `users` WHERE `wallet` = :wallet");
        $connect->execute(array('wallet' => $this->inputWallet));

     if($array = $connect->fetch(\PDO::FETCH_ASSOC)){
        $this->createCookie($array['id']);
     }else{
         unset($array);
         //We also need to check if the ref exists
         //To do this, we make a request, and if there is, we put + to the inviter and write it to ourselves
         $ref = $this->DB->prepare("SELECT * FROM `users` WHERE `wallet` = :ref");
         $ref->execute(array('ref' => $this->refer));
         
         if($array_Ref = $ref->fetch(\PDO::FETCH_ASSOC) and $this->inputWallet != $this->refer){
            $update = $this->DB->prepare("UPDATE `users` SET `referrals` = :referrals WHERE `id` = :id");
            $update->execute(array('referrals' => $array_Ref['referrals'] + 1,  'id' => $array_Ref['id']));
            $referal = $array_Ref["wallet"];
         }else{
             $referal = "";
         }

        $Insert = $this->DB->prepare("INSERT INTO `users` SET `wallet` = :wallet, `ref` = :ref, `lastclaim` = :lastclaim");
        $Insert->execute(array('wallet' =>  $this->inputWallet, 'ref' => $referal, 'lastclaim' => time()-3800));
        $this->createCookie($this->DB->lastInsertId());
     }
     
    }


    /**
     * The method that creates the cookie made a method to avoid duplicate lines
     * (Maybe it's a bug, but sometimes cookies get lost.)
     */
    private function createCookie($id){
        setcookie("wallet", $this->inputWallet, time() + 2629743, "/");
        setcookie("id", md5($id), time() + 2629743, "/");
    }

 
}