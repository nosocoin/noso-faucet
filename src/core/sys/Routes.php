<?php

namespace NosoProject\core\sys;

/**
 * Это класс который реализовует роутинг проекта
 * 
 */
class Routes{
    
    private $REQUEST_URI;
    public $Routes = Array();

    public function __construct(){

        $this->REQUEST_URI = htmlspecialchars($_SERVER['REQUEST_URI']);
    }


   
    /**
     * Метод который добавляет новый маршрут
     * @param string $rout - Строка маршрута или выражение
     * @param callable $function - Функция для вызова
     */
    public function add($rout, $function){
            array_push($this->Routes, Array(
              'rout' => $rout,
              'function' => $function
            ));
    }


    /**
     * В данном методе мы должны перечисоить массив адресов
     * Если есть совпадения то запустить код который вызван
     * Если совпадений нет перенаправить на шлавную страницу
     * 
     */
    public function run(){
        $countRoute;
        foreach ($this->Routes as $route) {
          
            if($this->REQUEST_URI == $route['rout']){
            echo "Class Route ->".$route['rout']."</br>";
            $countRoute = true;
            }

          
        }

        if(!$countRoute){
                 header("Location: /404");
             }
    }
}