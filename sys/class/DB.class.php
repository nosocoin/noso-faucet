<?php


/**
 * Class conected to DataBase MySQL
 */
class DB{


    public static function connectSQL(){
      try {
       return  new PDO('mysql:dbname=faucet;host=127.0.0.1:3306', 'root', '');
      } catch (PDOException $e) {
        return false;
        die("mysql connection error");
      }
    }
  
  

}