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
  private $FaucetSettings;



  public function __construct($container)
  {
    $this->FaucetSettings = $container->get('FaucetSettings');
    $this->UserArray = $container->get('UserAuthInfo');
    $this->DB = $container->get('db');
    $this->AccessClaim = CheckAccesClaim::Run($this->UserArray['lastclaim'],$container->get('FaucetSettings'));
  }


  public function OptionsArray()
  {
    return [
      'title' => 'Home Page',
      'Wallet' => $this->UserArray['wallet'],
      'Ballance' => $this->UserArray['balance'],
      'NosoAllTime' => $this->GetCountAllPaid(),
      'Referrals' => $this->GetCountRefferals(),
      'FromReferals' => $this->UserArray['refBalance'],
      'TotalPaidOut' => $this->UserArray['paidOut'],
      'RefLink' => $this->GetRefLinks(),
      'ViewPayments' => true,
      'ViewClaim' =>  $this->AccessClaim,
      'NosoPayConfig' =>  $this->FaucetSettings['NOSO_PAY'],
      'NextClaim' => $this->GetNextClaim(),
      'ClaimTime' => CoreFunctional::SetTime($this->FaucetSettings['CLAIM_TIME']),
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
  private function GetCountAllPaid()
  {
    return $this->UserArray['balance'] + $this->UserArray['paidOut'] + $this->UserArray['refBalance'];
  }

  /**
   * Time left until the next claim
   */
  private function GetNextClaim()
  {
    return CoreFunctional::SetTime(($this->UserArray['lastclaim'] + $this->FaucetSettings['CLAIM_TIME']) - time());
  }

  /**
   * Returns referral link
   */
  private function GetRefLinks()
  {
    return $_SERVER['HTTP_HOST'] . '/ref/' . $this->UserArray['wallet'];
  }
}
