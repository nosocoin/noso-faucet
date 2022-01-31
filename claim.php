<? 
define('pasichDev', 1);
require_once("sys/core.php");
require_once("sys/lib/recaptchalib.php");
$start_time = core::startInfoGen();


//Проверка на существование пользователя
 if($user_id>=1 and isset($user_wallet) && (userInfo::$user_LASTCLAIM+config::$ClaimTime)<time()){

if(!userInfo::$user_ver_KEY==$_POST['TOKEN_HIDEEN']){
    unset($_POST['TOKEN_HIDEEN']);
    unset($user_ver_KEY);
    core::cleanTokenClaim($user_id);
    header("Location: $home/?");
}else{

    if(core::__checkGET("check")=="pay"){
    $recaptcha_response = null;
    $recaptcha_class = new ReCaptcha(config::$secret_key_RE);
    if(isset($_POST["g-recaptcha-response"])) {
        $recaptcha_response = $recaptcha_class->verifyResponse(
            $_SERVER["REMOTE_ADDR"],
            $_POST["g-recaptcha-response"]
        );
    }
     
    if($recaptcha_response != null && $recaptcha_response->success) {
        $TOKEN_HIDEEN = $_POST['TOKEN_HIDEEN'];
   
    
        //Здесь мы зачисляем полученно вознаграждения
        $sth = DB::connectSQL()->prepare("UPDATE `users` SET `balance` = :balance, `lastclaim` = :lastclaim WHERE `id` = :id");
        $sth->execute(array('balance' => userInfo::$user_BALANCE + config::$NosoPay,'lastclaim' => time(), 'id' => $user_id));
        unset($sth);
        //Здес мы впишем претензию  в архив
        $Insert = DB::connectSQL()->prepare("INSERT INTO `claim` SET `wallet` = :wallet, `date` = :date, `noso` = :noso");
        $Insert->execute(array('wallet' =>  userInfo::$user_WALLET, 'date' => time(), 'noso' => config::$NosoPay));
        unset($Insert);
        //Здесь мы получем процент для пользователя
        $claimNoso = config::$NosoPay * config::$percentRef;
        $ref = DB::connectSQL()->prepare("UPDATE `users` SET `balance` = `balance` + :balance,  `refBalance` = `refBalance` + :refBalance  WHERE `wallet` = :wallet");
        $ref->execute(array('balance' =>  $claimNoso, 'refBalance' =>  $claimNoso,  'wallet' => userInfo::$user_REF));

        header("Location: $home/?");
    } else {
        $error = '<div class="notification is-danger">Check failed</div>';
    }
  }



//Подключим шапку проекта 
echo layout::HeadLayout(config::$title);

if(!empty($error)) echo $error;
echo "<div class='box'><h5 class='title is-5'>2. Solve Captcha</h5>
<form action='".config::$home."/claim.php?check=pay' method='POST'>
<input type='hidden' name='TOKEN_HIDEEN' value=".core::genTokenClaim($user_id).">
<div class='g-recaptcha' data-sitekey='".config::$public_key_RE."'></div>
    <div class='control field is-grouped is-grouped-right has-background-white'>
    <button type='submit' class='button is-warning'>Claim</button></div>
    </form></div>";


echo layout::EndLayout($start_time);
} }else{header("Location: auth.php");}
 


?>

<script src='https://www.google.com/recaptcha/api.js?hl=ru'></script>




