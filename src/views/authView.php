<?php

namespace NosoProject\views;
use NosoProject\core\DB;
use NosoProject\core\coreFunctional;


class authView {

    public function __construct($err=false) {
      $this->error = $err; 
      $this->DB = DB::connectSQL();
      $this->coreFunctional = new coreFunctional();
      $this->view();
    }

    /**
     * Get the number of users
     */
    private function getCountUsers(){
      $inquiry = $this->DB->prepare("SELECT * FROM `users`");
      $inquiry->execute();
      return $this->coreFunctional->formatNumber($inquiry->rowCount());
    }

    /**
     * Get the number of Paid of NOSO
     */
    private function getCountPaidNoso(){
      $inquiry = $this->DB->prepare("SELECT sum(noso) FROM `claim` ");
      $inquiry->execute();
      return $this->coreFunctional->formatNumber($inquiry->fetchColumn());
    }

    /**
     * Get the number of payments
     */
    private function getCountPayments(){
      $inquiry = $this->DB->prepare("SELECT * FROM `payments` WHERE  `status` ");
      $inquiry->execute(array('ok'));
      return $this->coreFunctional->formatNumber($inquiry->rowCount());
    }

    private function view(){
      echo '<div class="columns"><div class="column is-half">'.PHP_EOL;
      if($this->error)
      echo '<div class="notification is-danger">Need to provide a valid address</div>'.PHP_EOL;
      echo '<article class="message is-black">'.PHP_EOL;
      echo '<div class="message-header"><p>Login</p></div>'.PHP_EOL;
      echo '<div class="message-body has-background-white	">
            <form action="/auth/login" method="post">'.PHP_EOL;
      echo '<div class="control has-background-white">
            <input class="input is-danger" type="text" name="walletAdress" placeholder="Enter Noso-coin wallet address" required>
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
            <p class="title">'.$this->getCountUsers().'</p>
            </div></div>'.PHP_EOL;
      echo '<div class="level-item has-text-centered"><div>
            <p class="heading">Paid to NOSO</p>
            <p class="title">'.$this->getCountPaidNoso().'</p>
            </div></div>'.PHP_EOL;
      echo '<div class="level-item has-text-centered"><div>
            <p class="heading">Payments made</p>
            <p class="title">'.$this->getCountPayments().'</p>
            </div></div>'.PHP_EOL;
      echo '</nav></div></div></div>'.PHP_EOL;
    }
}
