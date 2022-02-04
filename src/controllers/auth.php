<?php

namespace NosoProject\controllers;

class auth {

    public function __construct() {
    }



    public static function post(){
      echo $_POST['wallet'];
    }

    public static function view(){
      echo '<div class="columns"><div class="column is-half">'.PHP_EOL;
      echo '<article class="message is-black">'.PHP_EOL;
      echo '<div class="message-header"><p>Login</p></div>'.PHP_EOL;
      echo '<div class="message-body has-background-white	">
            <form action="/auth/login" method="post">'.PHP_EOL;
      echo '<div class="control has-background-white">
            <input class="input is-danger" type="text" name="wallet" placeholder="Enter Noso-coin wallet address" required>
            </div>'.PHP_EOL;
      echo '<div class="field is-grouped is-grouped-centered">
            <div class="control has-background-white">
            <button class="button is-danger">Login</button>
            </div></div>'.PHP_EOL;
      echo '</form></div></article></div>'.PHP_EOL;
      echo '<div class="column">
            <article class="message is-black">'.PHP_EOL;
      echo '<div class="message-header"><p>What it is?</p></div>'.PHP_EOL;
      echo '<div class="message-body has-background-white	">
          Noso is a cryptocurrency, created entirely from scratch, using the knowledge learned from more than a decade of blockchain technology.
          With Noso, all users can manage their own wallet without intermediaries or heavy blockchains. </div>'.PHP_EOL;
      echo '</article></div></div>'.PHP_EOL;
    }
}
