<? 
define('pasichDev', 1);

require_once("sys/core.php");
$start_time = core::startInfoGen();


 if($user_id>=1 and isset($user_wallet)){
echo layout::HeadLayout(config::$title);


echo '<div class="columns"><div class="column is-half">
<div class="notification is-warning is-light">
Minimum payout threshold <strong>'.config::$minNosoPAyments.' NOSO</strong></div>';

if(config::$minNosoPAyments<=userInfo::$user_BALANCE){
echo '<div class="message-header"><p>Pay</p></div><div class="box">
<div class="control has-background-white">
<h6 class="subtitle is-6 has-text-grey">On your balance of 35 NOSO you can request a payout</h6>
<form action="'.config::$home.'/claim.php" method="post">
  <button class="button is-danger"><strong>Request a payout</strong></button></form>
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
      <th>Status</th>
      <th>Number of coins</th>
      <th>Time</th>
   </tr>
</thead>
<tbody>
   <tr>
      <td>Inquiry</td>
      <td>50 NOSO</td>
      <td>12.01.22 18:34</td>
   </tr>
   <tr>
      <td>Paid out</td>
      <td>50 NOSO</td>
      <td>12.01.22 18:34</td>
   </tr>
   <tr>
      <td>Paid out</td>
      <td>50 NOSO</td>
      <td>12.01.22 18:34</td>
   </tr>
</tbody>
</table></div></div></div></div></div>';




echo layout::EndLayout($start_time);
 }else{header("Location: auth.php");}

 
?>






