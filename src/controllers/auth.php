<?php

namespace NosoProject\controllers;



/**
 * Что еще нужно сделать?
 * - окраугление к тысячам и сотням для  статистики
 */

class auth {

      protected $count_users = 0;
      protected $count_claims = 0;
      protected $count_payments = 0;

    public function __construct() {
    }



    public static function post(){
      echo $_POST['wallet'];
    }

    public function view(){
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
      echo '<div class="message-body has-background-white">
          Noso is a cryptocurrency, created entirely from scratch, using the knowledge learned from more than a decade of blockchain technology.
          With Noso, all users can manage their own wallet without intermediaries or heavy blockchains. </div>'.PHP_EOL;
      echo '</article>'.PHP_EOL;
      echo '<div class="box">'.PHP_EOL;
      echo '<nav class="level">'.PHP_EOL;
      echo '<div class="level-item has-text-centered"><div>
            <p class="heading">Users</p>
            <p class="title">'.$this->count_users.'</p>
            </div></div>'.PHP_EOL;
      echo '<div class="level-item has-text-centered"><div>
            <p class="heading">Claims</p>
            <p class="title">'.$this->count_claims.'</p>
            </div></div>'.PHP_EOL;
      echo '<div class="level-item has-text-centered"><div>
            <p class="heading">Payments made</p>
            <p class="title">'.$this->count_payments.'</p>
            </div></div>'.PHP_EOL;
      echo '</nav></div>'.PHP_EOL;
      echo '</div></div>'.PHP_EOL;
    }
}
