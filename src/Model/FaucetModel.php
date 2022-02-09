<?php

namespace NosoProject\Model;

final class FaucetModel {
    private $DB;

    public function __construct($DB){
            $this->DB = $DB;
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