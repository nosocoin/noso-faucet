<?php

namespace NosoProject\Methods;

final class GenCode {
   /**
    * Method that generates a key to verify verification to receive a claim
    */
   static function GenTokenClaim($wallet, $db){
        $TOKEN = md5(rand(1,1200) * rand(5,20));
        $db = $db->prepare("UPDATE `users` SET `keyClaimVer` = :keyClaimVer WHERE `wallet` = :wallet");
        $db->execute(array('keyClaimVer' => $TOKEN, 'wallet' => $wallet));
        return $TOKEN;
       }
      
}
