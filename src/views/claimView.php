<?php

namespace NosoProject\views;
use NosoProject\core\userInfo;
use NosoProject\core\checkAcces;


class claimView{

    private $userInfo;

    /**
     * Здесь мы делаем отображение подтверджения претензии
     * В бэкенеде нам нужно проверить код который мы сгенереровали в бд
     * проверять его нужно при начислении монет, а перепередавать нам нужно при отправке ответа на рекапчу
     */


    public function __construct(){
        $this->userInfo = new userInfo();
        new checkAcces($this->userInfo, $this->view());
    }



    private function view(){

        /**
         * Здесь нужно перегенерровать ключ и отправить на бэкенд
         * А также реализовать реламный блок
         */
        echo '<div class="columns"><div class="column is-half">'.PHP_EOL;
        echo '<div class="box"><h5 class="title is-5">2. Solve Captcha</h5>'.PHP_EOL;
        echo '<form action="/claim/check" method="POST">
              <input type="hidden" name="TOKEN_HIDEEN" value="">'.PHP_EOL;
        echo '<div class="g-recaptcha" data-sitekey="'.$_ENV['PUBLIC_KEY_RE'].'"></div>'.PHP_EOL;
        echo '<div class="control field is-grouped is-grouped-right has-background-white">
              <button type="submit" class="button is-warning">Claim</button></div>'.PHP_EOL;
        echo '</form></div></div>'.PHP_EOL;

        echo '<div class="column">'.PHP_EOL;
        echo '<div class="message-header"><p>ADDS BLOCK </p></div>'.PHP_EOL;
        echo '<div class="box"></div>'.PHP_EOL;
        echo '</div></div>'.PHP_EOL;

    }

}

?>
<script src='https://www.google.com/recaptcha/api.js?hl=ru'></script>
