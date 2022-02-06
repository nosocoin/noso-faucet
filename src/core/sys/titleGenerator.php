<?php

namespace NosoProject\core\sys;

/**
 * an object that generates the title of the page depending on the path
 */
class titleGenerator{

    public static function output(){
        switch($_SERVER['REQUEST_URI']) {
            case '/': 
               return "Home Page";
            break;
            case '/auth': 
                return "Authorization";
            break;
            case '/faq':
                return "Frequently asked Questions";
            break;
            case '/payments':
                return "Payments";
                break;
            default:
                return "Home Page";
                break;
        }
    }

}