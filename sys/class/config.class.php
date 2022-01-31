<?php
defined('pasichDev') or die('Access is denied');

/**
 * Это класс переменых, который нужно изменянть
 */
class config {
  public static $home = 'http://192.168.0.106'; // Ссылка на ваш сайт (Нужно изменить, в конце оставить слеш)
  public static $description =''; // description
  public static $keywords =''; // keywords
  public static $title = 'Faucet - Noso-Coin';
  public static $NosoPay = 0.1; // Количество монет которые выплачиваються за одну претензию
  public static $ClaimTime = 60 ; //Интервал между претензиями указывать в UNIX
  public static $ClaimTimeConvert = 60 ; //Интервал между претензиями указывать минутах
  public static $minNosoPAyments = 100; //Минимальное количество NOSO для выплаты
  public static $percentRef = 0.5;  //Процент который получает рефферал
  
  //Ключи для REcapcha
  public static $public_key_RE = "6Ldq8EUeAAAAABlQSsRPmQoJ19SiDdNSFx7JiUCV";
  public static $secret_key_RE = "";
}