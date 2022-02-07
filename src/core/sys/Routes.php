<?php

namespace NosoProject\core\sys;

/**
 * This is the class that implements project routing
 */

class Routes{
    
    private $REQUEST_URI;
    private $Routes = Array();
    public  $arq;

    public function __construct(){
        $this->REQUEST_URI = htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES);
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
     * Method that starts routing when there is an array
     */
    public function run(){

        $countRoute = false;
        $ParseUrl = parse_url($this->REQUEST_URI);

        foreach ($this->Routes as $route) {

                $ParseRoute = parse_url($route['rout']);

            //If this is not the main page, you need to cut off at the end /
            if(!$route['home']){
                $ParseUrl['path'] = rtrim($ParseUrl['path'], '/');
            }


            /**
             * Let's check if there is a given route in this array
             * If the route is found then stop parsing the array
             * If there is no route, then we should send the user to /404
             */
            if($ParseUrl['path'] == $ParseRoute['path'] ){

               //If there is a value, then check it
                if(isset($ParseUrl['query'])){
                  $this->arq = htmlspecialchars($ParseUrl['query'], ENT_QUOTES);
                }

                if(isset($route['function'])){
             //   call_user_func($route['function']);
                }
               
                call_user_func( array('NosoProject\test', 'start'));
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