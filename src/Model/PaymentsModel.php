<?php

namespace NosoProject\Model;

final class PaymentsModel
{
  private $UserArray;
  private $DB;

  public function __construct($container)
  {
    $this->UserArray = $container->get('UserAuthInfo');
    $this->DB = $container->get('db');
  }


  public function OptionsArray()
  {
    return [
      'title' => 'Payments',
      'ViewPayments' => false,
      'MinimymPayNoso' => $_ENV['MIN_NOSO_PAYMENTS'],
      'WalletUser' => $this->UserArray['wallet'],
      'ArrayClaims' => $this->GetArrayClaims(),
      'ArrayPayments' => $this->GetArrayPayments()
    ];
  }


  /**
   * This method returns the last 8 claims in an array
   */
  private function GetArrayClaims()
  {
    $claim = $this->DB->prepare("SELECT * FROM `claim` WHERE `wallet`= :wallet ORDER BY `date` DESC LIMIT 8");
    $claim->execute(array('wallet' => $this->UserArray['wallet']));
    return $claim->fetchAll(\PDO::FETCH_ASSOC);
  }

  /**
   * This method returns an array of data about the latest payments to the wallet!
   */
  private function GetArrayPayments()
  {
    $paymnets = $this->DB->prepare("SELECT * FROM `payments` WHERE `wallet`= :wallet ORDER BY `date` DESC ");
    $paymnets->execute(array('wallet' => $this->UserArray['wallet']));
    return $paymnets->fetchAll(\PDO::FETCH_ASSOC);
  }
}
