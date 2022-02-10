<?php

namespace NosoProject\Model;

final class FaucetModel {
    public $UserArray;


    public function __construct($container){
            $this->UserArray = $container->get('db');
    }


    public function OptionsArray(){
      return [
				'title' => 'Home Page',
        'Wallet' => 'sdkasdkaskdaksada',
        'Ballance' => '0',
        'NosoAllTime' => '0',
        'Referal' => '0',
        'FromReferals' => '0',
        'TotalPaidOut' => '23',
        'RefLink' => 'http://localhost:8080/',
      ];
    }

}