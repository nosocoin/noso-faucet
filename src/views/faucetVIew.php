<?php

namespace NosoProject\views;
use NosoProject\core\userInfo;
use NosoProject\core\checkAcces;

class faucetView{

    private $userInfo;
    

    public function __construct(){
        $this->userInfo = new userInfo();
        new checkAcces($this->userInfo, $this->view()); //Обьект который проверяет доступность, нужно передать массив данных о пользователе и метод выю родителя
    }


    private function view(){
        echo "yes connected";
        
    }



}

