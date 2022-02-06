<?php

namespace NosoProject\core;
use NosoProject\core\sys\DB;

class genVerificationCode{

    /**
     * The method that generates the code to validate the claim
     */
    public static function output($userWallet){
    $TOKEN = md5(rand(1,1200) * rand(5,20));
    $db = DB::connectSQL()->prepare("UPDATE `users` SET `keyClaimVer` = :keyClaimVer WHERE `wallet` = :wallet");
    $db->execute(array('keyClaimVer' => $TOKEN, 'wallet' => $userWallet));
    return $TOKEN;
    }
}