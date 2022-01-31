<?php


/**
 * Данный класс реализовует авторизацию пользователя,
 * через форму авторизации auth.php
 * @checkWallet - вызиваеться для проверки валидности кошелька
 * @authStart - метод который  начинает авторизация пользователя
 */
class auth extends core{

    /**
     * Метод который проверяет адресс кошелька на существование
     * Если код ответа 200, и месендж OK. Значит кошелек валидный.
     * Если какие-либо другие ответы, кошелек не валидный
     */
    public static function checkWallet($wallet){
        $check = curl_init('https://explorer.nosocoin.com/api/v1/address/'.htmlspecialchars($wallet).'.json');
        curl_setopt($check, CURLOPT_RETURNTRANSFER, true);
        $decode = json_decode(curl_exec($check), true);
        if($decode["code"] == 200 && $decode["message"] == "Ok"){
            return true;
        }else{
            return false;
        }
        curl_close($ch);
    }



    /**
     * Метод который авторизовует пользователя по адресу кошелька
     * Для начала мы проверим ли существует, данный адресс в базе
     * -- если адрес существует, то мы создадим куки и переадресуем пользователя на главную старницу 
     * ---- если адрес не существует то мы создадим запись в  бд, и продолжим авторизацию
     */
    public static function authStart($wallet,$refer=""){
        $DB = DB::connectSQL();
        $connect = $DB->prepare("SELECT * FROM `users` WHERE `wallet` = :wallet");
        $connect-> execute(array('wallet' => $wallet));

     if($array = $connect->fetch(PDO::FETCH_ASSOC)){
          self::createCOOKIE($wallet,$array['id']);
     }else{
         unset($array);

         //Еще нам нужно проверить ли существует реф
         //Для этого делаем запрос и если есть то мы ставим + пригласителю а себе пишем его
         $ref = $DB->prepare("SELECT * FROM `users` WHERE `wallet` = :ref");
         $ref-> execute(array('ref' => $refer));
         
         if($array_Ref = $ref->fetch(PDO::FETCH_ASSOC) and $wallet != $refer){
            $update  = $DB->prepare("UPDATE `users` SET `referrals` = :referrals WHERE `id` = :id");
            $update ->execute(array('referrals' => $array_Ref['referrals'] + 1,  'id' => $array_Ref['id']));
            $referal = $array_Ref["wallet"];
         }else{
             $referal = "";
         }


        $Insert = $DB->prepare("INSERT INTO `users` SET `wallet` = :wallet, `ref` = :ref, `lastclaim` = :lastclaim");
        $Insert->execute(array('wallet' =>  htmlspecialchars($wallet), 'ref' => htmlspecialchars($referal), 'lastclaim' => time()-3800));
        $id =  $DB->lastInsertId();
        self::createCOOKIE($wallet,$id);
     }
    }


    /**
     * Метод который создает куки, сделал методом чтобы не дублировать строки
     */
    public static function createCOOKIE($wallet,$id){
        setcookie("wallet", $wallet, time() + 2629743);
        setcookie("id", md5($id), time() + 2629743);
    }

    /**
     * Метод который заносит адресс кошелька в куки для регистрации
     */
    public static function createCOOKIE_REF($ref){
        setcookie("ref", $ref, time() + 3600);
    }
}