<?php

namespace NosoProject\views;

class notFoundView{


    public static function view(){
        echo '<div class="field has-addons has-addons-centered">'.PHP_EOL;
        echo '<figure>
              <img src="/img/404.svg">
              </figure>'.PHP_EOL;
        echo '</div>';
    }

}