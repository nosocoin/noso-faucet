<?
defined('pasichDev') or die('Access is denied');


class core {

  /**
   * Начнем подсчет времени генерации страницы
   */
   public static function startInfoGen(){
    $start_array = explode(" ", microtime());
    return $start_array[1] + $start_array[0];
  }
  
  /**
   * Закончим подсчет генерации страницы
   * и веренем результат
   */
  public static function endInfoGen($start_time){
    $end_array = explode(" ", microtime());
    $end_time = $end_array[1] + $end_array[0];

    return  mb_strimwidth($end_time - $start_time, 0 ,6);
  }

  /**
   * Метод который создадит ключ для проверки верифкации для получения притензии
   */
 public static function genTokenClaim($user_id){
  $TOKEN = md5(rand(1,1200) * rand(5,20));
  $db = DB::connectSQL()->prepare("UPDATE `users` SET `keyClaimVer` = :keyClaimVer WHERE `id` = :id");
  $db->execute(array('keyClaimVer' => $TOKEN, 'id' => $user_id));
  return $TOKEN;
 }


 /**
  * Метод который уничтожает ключ верификаци в БД
  */
 public static function cleanTokenClaim($user_id){
  $db = DB::connectSQL()->prepare("UPDATE `users` SET `keyClaimVer` = :keyClaimVer WHERE `id` = :id");
  $db->execute(array('keyClaimVer' => "", 'id' => $user_id));
 }

  public static function __checkGET($arg) {
    if(isset($_GET[$arg]))
    return $_GET[$arg];
    else return "";
  }


  public static function converTime($time){

    if($time==3600){
      $return = date('h:i', $time);
    }elseif($time<=60){
      $return = date('s second', $time);
    }else{
      $return = date('i ', $time);
    }

    return $return;

  }

  


 public static function Sec2Time($time){
    if(is_numeric($time)){
    $value = array("years" => 0, "days" => 0, "hours" => 0,
    "minutes" => 0, "seconds" => 0,);
    if($time >= 86400){
    $value["days"] = floor($time/86400);
    $time = ($time%86400);
    }
    if($time >= 3600){
    $value["hours"] = floor($time/3600);
    $time = ($time%3600);
    }
    if($time >= 60){
    $value["minutes"] = floor($time/60);
    $time = ($time%60);
    }
    $value["seconds"] = floor($time);
        if($value["seconds"]>0){
      $time5 = $value["seconds"].' sec. ';
      }else{
      $time5='';
      }
      if($value["minutes"]>0){
      $time4 = $value["minutes"].' min. ';
      }else{
      $time4='';
      }
      if($value["hours"]>0){
      $time3 = $value["hours"].' h. ';
      }else{
      $time3='';
      }
        if($value["days"]>0){
      $time2 = $value["days"].' day ';
      }else{
      $time2='';
      }
     
    return 	$time2.$time3.$time4.$time5;
    return (array) $value;
    }else{
    return (bool) FALSE;
    }
    }
}





