<?php

namespace NosoProject\core\sys;

/**
 * Это класс который реализовует роутинг проекта
 */

class Routes{
    
    private $REQUEST_URI;
    public  $Routes = Array();

    public function __construct(){
        $this->REQUEST_URI = htmlspecialchars($_SERVER['REQUEST_URI']);
    }


   
    /**
     * Method that adds a new route
     * @param string $rout - Route address
     * @param callable $function - Function to call
     * @param boolean $home - mark the home page (To avoid cutting the slashes)
     */
    public function add($rout, $function, $home=false){
            array_push($this->Routes, Array(
              'rout' => $rout,
              'function' => $function,
              'home' => $home
            ));
    }


    /**
     * Redirecting to the error page!
     */
    private function RedicretTo404 (){
        header("Location: /404");
    }

    /**
     * В данном методе мы должны перечисоить массив адресов
     * Если есть совпадения то запустить код который вызван
     * Если совпадений нет перенаправить на 404
     * 
     */
    public function run(){

        $countRoute = false;
        $ParseUrl = parse_url($this->REQUEST_URI);

        foreach ($this->Routes as $route) {

                $ParseArayRoute = parse_url($route['rout']);

            //If this is not the main page, you need to cut off at the end /
            if(!$route['home']){
                $ParseUrl['path'] = rtrim($ParseUrl['path'], '/');
                //echo "Здесь мы  обрезали ".$ParseArayRoute['path']."</br>";
            }


            /**
             * Let's check if there is a given route in this array
             * If the route is found then stop parsing the array
             * If there is no route, then we should send the user to /404
             */
            if($ParseUrl['path'] == $ParseArayRoute['path'] ){

                echo "Здесь отображаем ->".$ParseArayRoute['path']."</br>";
                $countRoute = true;
               
            }

            if($countRoute) {
                break;
              }
        }

       
        if(!$countRoute){
               $this->RedicretTo404();
         }    
    }
}