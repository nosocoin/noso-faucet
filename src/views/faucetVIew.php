<?php

namespace NosoProject\views;
use NosoProject\core\userInfo;
use NosoProject\core\checkAcces;
use NosoProject\core\sys\coreFunctional;

class faucetView{

    private $userInfo;
    private $coreFunctional;
    

    public function __construct(){
        $this->userInfo = new userInfo();
        $this->coreFunctional = new coreFunctional();
        
        new checkAcces($this->userInfo, $this->view()); 
    }


   

    /**
     * Method that returns the number of payments for all time
     */
    private function getCountAllPaid(){
        return $this->userInfo->userBalance + $this->userInfo->userPaidOut;
    }


    private function view(){
    
        echo '<div class="columns"><div class="column is-half">'.PHP_EOL;
        echo '<div class="box"><div class="control has-background-white">
              <h6 class="title is-6">Wallet:</h6>
              <h6 class="subtitle is-6 has-text-grey">'.$this->userInfo->userWallet.'</h6>
              </div>'.PHP_EOL;
        echo '<div class="control has-background-white">
              <h6 class="title is-6">Balance:</h6>
              <h6 class="subtitle is-6 has-text-warning-dark">'.$this->userInfo->userBalance.' NOSO</h6>
              </div></div>'.PHP_EOL;
              $this->viewClaim();
        echo '</div><div class="column">'.PHP_EOL;
        echo '<div class="message-header"><p>Stats</p></div>'.PHP_EOL;
        echo '<div class="box">'.PHP_EOL;
        echo '<div class="control has-background-white">
              <h6 class="title is-6">Earned all time:</h6>
              <h6 class="subtitle is-6 has-text-warning-dark">'.$this->getCountAllPaid().' NOSO</h6>
              </div>'.PHP_EOL;
        echo '<div class="control has-background-white">
              <h6 class="title is-6">Referrals:</h6>
              <h6 class="subtitle is-6 ">'.$this->userInfo->userReferals.'</h6>
              </div>'.PHP_EOL;
        echo '<div class="control has-background-white">
              <h6 class="title is-6">From referrals:</h6>
              <h6 class="subtitle is-6 has-text-warning-dark">'.$this->userInfo->userRefBalance.' NOSO</h6>
              </div>'.PHP_EOL;
        echo '<div class="control has-background-white">
              <h6 class="title is-6">Total paid out:</h6>
              <h6 class="subtitle is-6"><strong class=" has-text-danger-dark">'.$this->userInfo->userPaidOut.' NOSO</strong></h6>
              </div></div>'.PHP_EOL;
        echo '<div class="message-header"><p>Referrals Link</p></div>'.PHP_EOL;
        echo '<div class="box"><h6 class="subtitle is-6">
              <div class="notification is-white is-light">You can invite friends and get 50% of every claim made by a friend</div></h6>
              <div class="field has-addons">
              <p class="control is-expanded has-background-white">
              <input class="input" id="refLinks" type="text" value="'.$_SERVER['HTTP_REFERER'].'ref/'.$this->userInfo->userWallet.'"></p>
              <p class="control has-background-white">
              <button class="button is-black" onclick="copy()">Copy</button>
              </p></div>'.PHP_EOL;
        echo '</div></div></div>';

    }



    /**
     * Method that displays a window with the status of the claim
     */
    private function viewClaim(){

        /**
         * Нужно добавить генератор кода для проверки запроса 
         **/

        if(($this->userInfo->userLastclaim + $_ENV['CLAIM_TIME'])<time()){
         
        echo '<div class="box">
              <div class="control has-background-white">
              <h5 class="title is-5">1. Claim</h5>
              <h6 class="subtitle is-6 has-text-grey"> Rewards: 
              <strong class="has-text-warning-dark">'.$_ENV['NOSO_PAY'].' NOSO </strong> every  '.$this->coreFunctional->setTime($_ENV['CLAIM_TIME']).'</h6>'.PHP_EOL;
        echo '<form action="/claim" method="post">
              <input type="hidden" name="TOKEN_HIDEEN" value="">
              <button class="button is-danger"><strong>NEXT</strong></button></form>'.PHP_EOL;
        echo '</div></div>'; 
    }else {
        $timeWait = userInfo::$user_LASTCLAIM + config::$ClaimTime - time();

        echo '<div class="notification is-warning is-light">You have already claimed in the last '.core::Sec2Time(config::$ClaimTime).'</br>
        You can claim again in '.core::Sec2Time($timeWait).'</div>';
    }

    }
}

