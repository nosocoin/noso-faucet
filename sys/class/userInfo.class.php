<?
defined('pasichDev') or die('Access is denied');


class userInfo {
  public static $user_ID;
  public static $user_WALLET;
  public static $user_BALANCE;
  public static $user_LASTCLAIM;
  public static $user_REFERALS;
  public static $user_REF;
  public static $user_REFBALANCE;
  public static $user_PAID_OUT;
  public static $user_ver_KEY;

  function __construct(){
      if (isset($_COOKIE["wallet"]) && isset($_COOKIE["id"])){
      $this->userInfo(htmlspecialchars($_COOKIE["wallet"]),
      htmlspecialchars($_COOKIE["id"]));
      }
    }

  public static function userInfo($CO_wallet,$CO_id){
    $connect =  DB::connectSQL()->prepare("SELECT * FROM `users` WHERE `wallet` = :wallet");
    $connect -> execute(array('wallet' => $CO_wallet));

    if($array = $connect->fetch(PDO::FETCH_ASSOC)){
     if(md5($array['id'])==$CO_id){
    self::$user_ID = $array['id'];
    self::$user_WALLET = $array['wallet']; 
    self::$user_BALANCE = $array['balance'];
    self::$user_LASTCLAIM = $array['lastclaim'];
    self::$user_REF = $array['ref'];
    self::$user_REFERALS = $array['referrals'];
    self::$user_REFBALANCE = $array['refBalance'];
    self::$user_PAID_OUT = $array['paidOut'];
    self::$user_ver_KEY = $array['keyClaimVer'];
  }
  }else{
  self::$user_ID = 0;
  self::$user_WALLET = "";
 }

}


}





