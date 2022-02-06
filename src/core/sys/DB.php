<?php

namespace NosoProject\Core\sys;

class DB {

    public function __construct() {
    }

    public static function connectSQL(){
        try {
         return  new \PDO('mysql:dbname='.$_ENV['FAUCET_DATABASE'].';host='.$_ENV['FAUCET_DATABASE_HOST'].'', $_ENV['FAUCET_DATABASE_USER'], $_ENV['FAUCET_DATABASE_PASSWORD']);
        } catch (PDOException $e) {
          return false;
        }
      }
    
  
}
