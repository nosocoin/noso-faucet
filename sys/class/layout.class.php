<?
defined('pasichDev') or die('Access is denied');


class layout {
 
  public static function HeadLayout($title){
    echo '<!DOCTYPE html><html><head>
    <link rel="stylesheet" href="'.config::$home.'/src/bulma.css"> 
    <link rel="stylesheet" href="'.config::$home.'/src/style.css"> 
    <script src="'.config::$home.'/src/js.js" ></script> 
    <link rel="apple-touch-icon" href="'.config::$home.'/src/img/apple_icon.png" type="image/png"/>
    <link rel="icon" href="'.config::$home.'/favicon.ico" type="image/x-icon"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="'.config::$description.'" />
    <meta name="keywords" content="'.config::$keywords.'" />
    <meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8"/>
    <title>'.$title.'</title></head><body>
    <nav class="navbar has-background-black	" role="navigation" aria-label="main navigation">
    <div class="container">
    <div class="navbar-brand">
    <div class="navbar-item"><img src="'.config::$home.'/src/img/apple_icon.png" width="24" height="24"></div>
    <a role="button" class="navbar-burger burger has-text-white-ter	" aria-expanded="false" data-target="navbarBasicExample">
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span></a> </div>
      <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
    <a href="'.config::$home.'/?" class="navbar-item has-text-grey">Faucet</a>
    <a href="'.config::$home.'/payments.php" class="navbar-item  has-text-grey">Payments</a>
    <a href="'.config::$home.'/faq.php" class="navbar-item  has-text-grey">F.A.Q</a>
    </div></div></div></nav>
      <div class="body"><div class="container">';
  }

  public static function EndLayout($start_time){
    echo '</div></div>
    <footer class="footer"><div class="content has-text-centered"><p>
    <strong class="has-text-warning-dark">Faucet: Noso-Coin</strong>
    </br><small> gen: <b>'.core::endInfoGen($start_time).'s</b> </smal></p></div></footer>  
    </div></body></html>';
  }
}






