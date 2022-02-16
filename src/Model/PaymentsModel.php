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


    ];
  }




}

