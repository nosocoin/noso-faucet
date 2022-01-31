<? 
define('pasichDev', 1);

$root = "";
$allow = false;
require_once("sys/core.php");
$start_time = core::startInfoGen();


 if($user_id>=1 and isset($user_wallet)){
echo layout::HeadLayout(config::$title);


echo '<div class="columns"><div class="column is-half">';

echo '<div class="notification is-warning is-light">
Minimum payout threshold <strong>'.config::$minNosoPAyments.' NOSO</strong></div>';

if(config::$minNosoPAyments<=userInfo::$user_BALANCE){
echo '<div class="message-header"><p>Выплата</p></div><div class="box">
<div class="control has-background-white">
<h6 class="subtitle is-6 has-text-grey"> На вашем балансе 35 NOSO вы можете запросить выплату</h6>
<form action="'.$home.'/claim.php" method="post">
  <button class="button is-danger"><strong>Запросить выплату</strong></button></form>
</div></div>';
}





echo '<div class="message-header"><p>Last 20 claims</p></div>
<div class="box">
<div class="table-container">
<table class = "table">
<thead>
   <tr>
      <th>Claim time</th>
      <th>Number of coins</th>
   </tr>
</thead>

<tbody>
  '.payments::search_last_20_claim(userInfo::$user_WALLET).'
</tbody>
</table></div></div></div>';

echo '
<div class="column">
<div class="message-header"><p>Latest payments</p></div>
<div class="box">
<div class="table-container">
<table class = "table">
<thead>
   <tr>
      <th>Статус</th>
      <th>Количество монет</th>
      <th>Время</th>
   </tr>
</thead>

<tbody>
   <tr>
      <td>Запрос</td>
      <td>50 NOSO</td>
      <td>12.01.22 18:34</td>
   </tr>
   <tr>
      <td>Выплачено</td>
      <td>50 NOSO</td>
      <td>12.01.22 18:34</td>
   </tr>
   <tr>
      <td>Выплачено</td>
      <td>50 NOSO</td>
      <td>12.01.22 18:34</td>
   </tr>
</tbody>
</table></div></div></div></div></div>';




echo layout::EndLayout($start_time);

 }else{header("Location: auth.php");}
 


?>






