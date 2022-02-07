<?php

namespace NosoProject\views;

class Layout {

    private $title;
    private $description = "Faucet for NOSO COIN. AirDrop coins.";
    private $keywords = "Faucet, NOSOCOIN, AIDROP, NOSO-COIN, CRYPTO";

    public function __construct($title) {
        $this->title = $title; 
        $this->headLayout();
    }

    public function headLayout() {
        echo '<!DOCTYPE html><html><head>'.PHP_EOL;
        echo '<link rel="stylesheet" href="/css/bulma.css">'.PHP_EOL;
        echo '<link rel="stylesheet" href="/css/style.css"> '.PHP_EOL;
        echo '<script src="/js/js.js" ></script>'.PHP_EOL;
        echo '<link rel="icon" href="/img/favicon.png" type="image/x-icon"/>'.PHP_EOL;
        echo '<meta name="viewport" content="width=device-width, initial-scale=1">'.PHP_EOL;
        echo '<meta name="description" content="'.$this->description.'" />'.PHP_EOL;
        echo '<meta name="keywords" content="'.$this->keywords.'" />'.PHP_EOL;
        echo '<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8"/>'.PHP_EOL;
        echo '<title>Noso Faucet'.(empty($this->title)?'':': '.$this->title).'</title>'.PHP_EOL;
        echo '</head><body>'.PHP_EOL;
    }

    public function nav(){    
    echo '<nav class="navbar has-background-black" role="navigation" aria-label="main navigation">'.PHP_EOL;
    echo '<div class="container"><div class="navbar-brand">'.PHP_EOL;
    echo '<div class="navbar-item"><img src="/img/N3256x256.png" width="24" height="24"></div>
    <a role="button" class="navbar-burger burger has-text-white-ter	" aria-expanded="false" data-target="navbarBasicExample">
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span></a> </div>
      <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
    <a href="/" class="navbar-item has-text-grey">Faucet</a>
    <a href="/payments" class="navbar-item  has-text-grey">Payments</a>
    <a href="/faq" class="navbar-item  has-text-grey">F.A.Q</a>'.PHP_EOL;
    echo '</div></div></div></nav>'.PHP_EOL;
    echo '<div class="body"><div class="container body_container ">'.PHP_EOL;
    }

    public function footer() {
        echo '</div><footer class="footer"><div class="content has-text-centered"><p>
        <strong class="has-text-warning-dark">Noso Faucet</strong>
        </br><small>PasichDev</smal></p></div></footer>'.PHP_EOL;
        echo '</div></body></html>'.PHP_EOL;
    }




}
