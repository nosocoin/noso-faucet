<?php

namespace NosoProject\Model;
use NosoProject\Methods\GenCode;
use NosoProject\Lib\ReCaptcha;

final class ClaimModel {
    private $container;
    private $Settings;
    private $UserArray;
    private $DB;
    private $RecaptchaClass;
    private $RecaptchaResponse = null;

    public function __construct($container){
          $this->container = $container;
          $this->Settings = $container->get('settings')['recaptcha'];
          $this->UserArray = $container->get('UserAuthInfo');
          $this->DB = $container->get('db');
          $this->RecaptchaClass = new ReCaptcha($this->Settings['PrivateKey']);
    }



    /**
     * Напиши мини руководство, по поводу ключец генерации
     * 1. Открываем страницу фаусет
     * 2. На этой странице проверяем можно ли подать пост кнопки на второй степ
     * 2.1 Если можно то мы генерируем в этом условии код, который передает в бд и по пост
     * 3. Переходим сверяем код, если вс ок то переведим на дркгкю стрпнцу если нет очисчаем код в бд и возвращаем на фаусет
     * 4. На заключном етапе переводим код, в процессс и после всех дел очищаем код из бд и даем награду!
     * 
     * 
     */


      /**
	 * Array of settings for the view
	 */
	public function OptionArray(){
		return [
			'title' => 'Claim',
			'PublicKey' => $this->Settings['PublicKey'],
                  'TOKEN_HIDEEN' =>  GenCode::GenTokenClaim($this->UserArray['wallet'],$this->DB ),
                  'ViewPayments' => false
		];}

            

      public function Run(){
         if($this->ChecReCaptcha)
         $this->ClaimOkay;

      }
       

      protected function ClaimOkay(){
      //Здес мы впишем претензию  в архив
      $Insert = DB::connectSQL()->prepare("INSERT INTO `claim` SET `wallet` = :wallet, `date` = :date, `noso` = :noso");
      $Insert->execute(array('wallet' =>  $this->UserArray['wallet'], 'date' => time(), 'noso' => config::$NosoPay));
       


        //Здесь мы зачисляем полученно вознаграждения
        $sth = DB::connectSQL()->prepare("UPDATE `users` SET `balance` = :balance, `lastclaim` = :lastclaim WHERE `id` = :id");
        $sth->execute(array('balance' => userInfo::$user_BALANCE + config::$NosoPay,'lastclaim' => time(), 'id' => $user_id));
        unset($sth);
      
        unset($Insert);
        //Здесь мы получем процент для пользователя
        $claimNoso = config::$NosoPay * config::$percentRef;
        $ref = DB::connectSQL()->prepare("UPDATE `users` SET `balance` = `balance` + :balance,  `refBalance` = `refBalance` + :refBalance  WHERE `wallet` = :wallet");
        $ref->execute(array('balance' =>  $claimNoso, 'refBalance' =>  $claimNoso,  'wallet' => userInfo::$user_REF));


      }




      /**
       * Check ReCaptcha Code 
       */
       protected function ChecReCaptcha(){
                  if(isset($_POST["ReCaptchaResponse"])) {
                    $this->RecaptchaResponse = $recaptcha_class->verifyResponse(
                          $_SERVER["REMOTE_ADDR"],
                          $_POST["ReCaptchaResponse"]
                      );
                  }  
               return $recaptcha_response != null && $recaptcha_response->success;                   
       }


}