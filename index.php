<? 
define('pasichDev', 1);

require_once("sys/core.php");
$start_time = core::startInfoGen();

 if($user_id>=1 and isset($user_wallet)){

//Подключим шапку проекта 
echo layout::HeadLayout(config::$title);
$E_all_time = userInfo::$user_BALANCE + userInfo::$user_PAID_OUT;


echo '<div class="columns"><div class="column is-half">
<div class="box">
<div class="control has-background-white">
<h6 class="title is-6">Wallet:</h6>
<h6 class="subtitle is-6 has-text-grey">'.userInfo::$user_WALLET.'</h6>
</div>
<div class="control has-background-white">
<h6 class="title is-6">Balance:</h6>
<h6 class="subtitle is-6 has-text-warning-dark">'.userInfo::$user_BALANCE.' NOSO</h6>
</div></div>';




if((userInfo::$user_LASTCLAIM+config::$ClaimTime)<time()){
  if(!userInfo::$user_ver_KEY==""){
    core::cleanTokenClaim($user_id);
  }
echo '<div class="box">
<div class="control has-background-white">
<h5 class="title is-5">1. Claim</h5>
<h6 class="subtitle is-6 has-text-grey"> Rewards: <strong class="has-text-warning-dark">'.config::$NosoPay.' NOSO </strong> every  '.core::Sec2Time(config::$ClaimTime).'</h6>
<form action="'.$home.'/claim.php" method="post">
      <input type="hidden" name="TOKEN_HIDEEN" value="'.core::genTokenClaim($user_id).'">
  <button class="button is-danger"><strong>NEXT</strong></button></form>
</div></div>';
}else{


  $timeWait = userInfo::$user_LASTCLAIM + config::$ClaimTime - time();

  echo '<div class="notification is-warning is-light">You have already claimed in the last '.core::Sec2Time(config::$ClaimTime).'</br>
  You can claim again in '.core::Sec2Time($timeWait).'</div>';
 

}


echo '
</div>
<div class="column">
<div class="message-header"><p>Stats</p></div>
<div class="box">
<div class="control has-background-white">

<h6 class="title is-6">Earned all time:</h6>
<h6 class="subtitle is-6 has-text-warning-dark">'.$E_all_time.' NOSO</h6>
</div>
<div class="control has-background-white">
<h6 class="title is-6">Referrals:</h6>
<h6 class="subtitle is-6 ">'.userInfo::$user_REFERALS.'</h6>
</div>
<div class="control has-background-white">
<h6 class="title is-6">From referrals:</h6>
<h6 class="subtitle is-6 has-text-warning-dark">'.userInfo::$user_REFBALANCE.' NOSO</h6>
</div>
<div class="control has-background-white">
<h6 class="title is-6">Total paid out:</h6>
<h6 class="subtitle is-6"><strong class=" has-text-danger-dark">'.userInfo::$user_PAID_OUT.' NOSO</strong></h6>
</div></div>

<div class="message-header"><p>Referrals Link</p></div><div class="box">
<h6 class="subtitle is-6"><div class="notification is-warning is-light">You can invite friends and get 50% of every claim made by a friend</div></h6>

<div class="field has-addons">
<p class="control is-expanded has-background-white">
  <input class="input" id="refLinks" type="text" value="'.config::$home.'/auth.php?ref='.userInfo::$user_WALLET.'">
  </p>
  <p class="control has-background-white">
  <button class="button is-black" onclick="copy()">Copy</button>
</p>
</div>
</div>
</div></div>';



echo layout::EndLayout($start_time);

 }else{header("Location: auth.php");}
 


?>






