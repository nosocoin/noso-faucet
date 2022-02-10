<?php 

namespace NosoProject\Core;


/**
 * In this object we will store the methods that are needed for the project to work.
 */
class CoreFunctional{

    /**
     * Method that rounds to thousands and millions
     * (this method will need to be extended at some point)
     */
    public static function FormatNumber($number){
        if ($number < 1000) {
            return $number;
       }
       if ($number < 1000000) {
           return number_format($number / 1000,1) . 'k';
       }

       if ($number >= 1000000 && $number < 1000000000) {
           return number_format($number / 1000000,1) . 'M';
       }
    }

    
  

/**
* Need to rewrite this function it is very clumsy
* Used it back in 14
*/
 public static function SetTime($time){
    if(is_numeric($time)){
    $value = array("days" => 0, "hours" => 0,
    "minutes" => 0, "seconds" => 0,);
    if($time >= 86400){
    $value["days"] = floor($time/86400);
    $time = ($time%86400); }
    if($time >= 3600){
    $value["hours"] = floor($time/3600);
    $time = ($time%3600);  }
    if($time >= 60){
    $value["minutes"] = floor($time/60);
    $time = ($time%60);
    }
    $value["seconds"] = floor($time);
        if($value["seconds"]>0){
      $time5 = $value["seconds"].' sec. ';
      }else{
      $time5=''; }
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
    return (bool) FALSE; }
    }


}


