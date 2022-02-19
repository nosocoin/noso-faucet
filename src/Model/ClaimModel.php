<?php

namespace NosoProject\Model;

use NosoProject\Methods\GenCode;
use NosoProject\Lib\ReCaptcha;

final class ClaimModel
{
      private $container;
      private $Settings;
      private $UserArray;
      private $DB;
      private $RecaptchaClass;


      public function __construct($container)
      {
            $this->container = $container;
            $this->Settings = $container->get('settings')['recaptcha'];
            $this->UserArray = $container->get('UserAuthInfo');
            $this->DB = $container->get('db');
            $this->RecaptchaClass = new ReCaptcha($this->Settings['PrivateKey']);
      }

      /**
       * Array of settings for the view
       */
      public function OptionArray()
      {
            return [
                  'title' => 'Claim',
                  'PublicKey' => $this->Settings['PublicKey'],
                  'TOKEN_HIDEEN' =>  GenCode::GenTokenClaim($this->UserArray['wallet'], $this->DB),
                  'ViewPayments' => true
            ];
      }



      /**
       * The method that starts the calculation
       */
      public function Run()
      {
            if ($this->ChecReCaptcha())  $this->ClaimOkay();
      }


      protected function ClaimOkay()
      {
            //Здес мы впишем претензию  в архив
            $Insert = $this->DB->prepare("INSERT INTO `claim` SET `wallet` = :wallet, `date` = :date, `noso` = :noso");
            $Insert->execute(array('wallet' =>  $this->UserArray['wallet'], 'date' => time(), 'noso' => $_ENV['NOSO_PAY']));

            //Здесь мы зачисляем полученно вознаграждения
            $sth = $this->DB->prepare("UPDATE `users` SET `balance` = :balance, `lastclaim` = :lastclaim, `keyClaimVer` = '' WHERE `id` = :id");
            $sth->execute(array('balance' => $this->UserArray['balance'] +  $_ENV['NOSO_PAY'], 'lastclaim' => time(), 'id' =>  $this->UserArray['id']));

            if ($this->UserArray['ref']) {
                  //Здесь мы получем процент для пользователя
                  $ref = $this->DB->prepare("UPDATE `users` SET `refBalance` = `refBalance` + :refBalance  WHERE `wallet` = :wallet");
                  $ref->execute(array('refBalance' =>  $this->ClaimNosoRefPercent(),  'wallet' => $this->UserArray['ref']));
            }
      }


      /**
       * The percentage that the referee will receive
       */
      private function ClaimNosoRefPercent()
      {
            return  $_ENV['NOSO_PAY'] *  $_ENV['PERCENT_REF'];
      }


      /**
       * Check ReCaptcha Code 
       */
      protected function ChecReCaptcha()
      {
            $RecaptchaResponse = null;
            if (isset($this->container->get('POST')["g-recaptcha-response"])) {
                  $RecaptchaResponse = $this->RecaptchaClass->verifyResponse(
                        $_SERVER["REMOTE_ADDR"],
                        $this->container->get('POST')["g-recaptcha-response"]
                  );
            }
            return  $RecaptchaResponse != null && $RecaptchaResponse->success;
      }
}
