<?php

namespace NosoProject\Model;

use NosoProject\Core\CoreFunctional;
use NosoProject\Methods\GenCode;
use NosoProject\Methods\CheckAccesClaim;

final class FaucetModel
{
  private $UserArray;
  private $DB;
  private $AccessClaim;



  public function __construct($container)
  {
    $this->UserArray = $container->get('UserAuthInfo');
    $this->DB = $container->get('db');
    $this->AccessClaim = CheckAccesClaim::Run($this->UserArray['lastclaim']);
  }


  public function OptionsArray()
  {
    return [
      'title' => 'Home Page',
      'Wallet' => $this->UserArray['wallet'],
      'Ballance' => $this->UserArray['balance'],
      'NosoAllTime' => $this->getCountAllPaid(),
      'Referrals' => $this->GetCountRefferals(),
      'FromReferals' => $this->UserArray['refBalance'],
      'TotalPaidOut' => $this->UserArray['paidOut'],
      'RefLink' => $_SERVER['HTTP_HOST'] . '/ref/' . $this->UserArray['wallet'],
      'ViewPayments' => true,
      'ViewClaim' => $this->AccessClaim,
      'NosoPayConfig' => $_ENV['NOSO_PAY'],
      'ClaimTime' => CoreFunctional::SetTime($_ENV['CLAIM_TIME']),
      'TOKEN_HIDEEN' => $this->AccessClaim ? GenCode::GenTokenClaim($this->UserArray['wallet'], $this->DB) : ""
    ];
  }



  /**
   * Let's count the number of referrals
   */
  private function GetCountRefferals()
  {
    $inquiry = $this->DB->prepare("SELECT * FROM `users` WHERE  `ref` = :userWallet ");
    $inquiry->execute(array('userWallet' => $this->UserArray['wallet']));
    return $inquiry->rowCount();
  }

  /**
   * Method that returns the number of payments for all time
   */
  private function getCountAllPaid()
  {
    return $this->UserArray['balance'] + $this->UserArray['paidOut'] + $this->UserArray['refBalance'];
  }
}
