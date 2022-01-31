<?php
define('pasichDev', 1);

require_once("sys/core.php");
$start_time = core::startInfoGen();


if($user_id>=1 and isset($user_wallet)){
  header("Location: $home/?");
}else{

/**
 * Здесь мы должни получить по POOST
 * Адресс кошелька и проверить на существоввание и ошибки
 * 
 */
if(core::__checkGET("auth")=="start"){
  $postWallet = $_POST['wallet'];
  if(auth::checkWallet($postWallet)){
    auth::authStart($postWallet, $_COOKIE['ref']);
    header("Location: $home/?");
  }else{
   $error = '<div class="notification is-danger">Need to provide a valid address</div>';
  }
}

/**
 * Если есть отсылка на реферальный адресс то заносим в куки для храненения на час
 */
if(!empty(core::__checkGET("ref")) and empty($_COOKIE['ref'])){
auth::createCOOKIE_REF(core::__checkGET("ref"));
}



echo layout::HeadLayout("Faucet - Noso-Coin");
  echo '<div class="columns"><div class="column is-half">';
  if(!empty($error)) echo $error;
  echo '<article class="message is-black">
    <div class="message-header"><p>Login</p> </div>
    <div class="message-body has-background-white	">
    <form action="/auth.php?auth=start" method="post">
    <div class="control has-background-white	">
      <input class="input is-danger" type="text" name="wallet" placeholder="Enter Noso-coin wallet address" required>
    </div>
    <div class="field is-grouped is-grouped-centered">
    <div class="control has-background-white">
  <button class="button is-danger">Login</button></form>
  </div></div></article></div>
  <div class="column">
  <article class="message is-black">
    <div class="message-header"><p>What it is?</p></div>
    <div class="message-body has-background-white	">
    Noso is a cryptocurrency, created entirely from scratch, using the knowledge learned from more than a decade of blockchain technology.
    With Noso, all users can manage their own wallet without intermediaries or heavy blockchains. </div>
  </article></div></div>';

  echo layout::EndLayout($start_time);



}


