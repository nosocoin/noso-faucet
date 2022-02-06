<?php

namespace NosoProject\views;
use NosoProject\core\userInfo;
use NosoProject\core\checkAcces;

class faucetView{

    private $userInfo;
    

    public function __construct(){
        $this->userInfo = new userInfo();
        new checkAcces($this->userInfo, $this->view()); //Обьект который проверяет доступность, нужно передать массив данных о пользователе и метод выю родителя
    }


    private function view(){
     

//$E_all_time = userInfo::$user_BALANCE + userInfo::$user_PAID_OUT;


echo '<div class="columns"><div class="column is-half">'.PHP_EOL;
echo '<div class="box"><div class="control has-background-white">
<h6 class="title is-6">Wallet:</h6>
<h6 class="subtitle is-6 has-text-grey">'.$this->userInfo->userWallet.'</h6>
</div>'.PHP_EOL;
echo '<div class="control has-background-white">
<h6 class="title is-6">Balance:</h6>
<h6 class="subtitle is-6 has-text-warning-dark">'.$this->userInfo->userBalance.' NOSO</h6>
</div></div>'.PHP_EOL;

echo '<div class="box">
<div class="control has-background-white">
<h5 class="title is-5">1. Claim</h5>
<h6 class="subtitle is-6 has-text-grey"> Rewards: <strong class="has-text-warning-dark">'.$_ENV['NOSO_PAY'].' NOSO </strong> every  234342342</h6>'.PHP_EOL;

echo '<form action="/claim" method="post">
      <input type="hidden" name="TOKEN_HIDEEN" value="">
  <button class="button is-danger"><strong>NEXT</strong></button></form>'.PHP_EOL;
echo '</div></div>';


/*
  $timeWait = userInfo::$user_LASTCLAIM + config::$ClaimTime - time();

  echo '<div class="notification is-warning is-light">You have already claimed in the last '.core::Sec2Time(config::$ClaimTime).'</br>
  You can claim again in '.core::Sec2Time($timeWait).'</div>';
 
*/



echo '
</div>
<div class="column">
<div class="message-header"><p>Stats</p></div>
<div class="box">
<div class="control has-background-white">

<h6 class="title is-6">Earned all time:</h6>
<h6 class="subtitle is-6 has-text-warning-dark">42342 NOSO</h6>
</div>
<div class="control has-background-white">
<h6 class="title is-6">Referrals:</h6>
<h6 class="subtitle is-6 ">0</h6>
</div>
<div class="control has-background-white">
<h6 class="title is-6">From referrals:</h6>
<h6 class="subtitle is-6 has-text-warning-dark">0 NOSO</h6>
</div>
<div class="control has-background-white">
<h6 class="title is-6">Total paid out:</h6>
<h6 class="subtitle is-6"><strong class=" has-text-danger-dark">0 NOSO</strong></h6>
</div></div>

<div class="message-header"><p>Referrals Link</p></div><div class="box">
<h6 class="subtitle is-6"><div class="notification is-warning is-light">You can invite friends and get 50% of every claim made by a friend</div></h6>

<div class="field has-addons">
<p class="control is-expanded has-background-white">
  <input class="input" id="refLinks" type="text" value="/ref/">
  </p>
  <p class="control has-background-white">
  <button class="button is-black" onclick="copy()">Copy</button>
</p>
</div>
</div>
</div></div>';


        
    }



}

