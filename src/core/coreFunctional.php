<?php 

namespace NosoProject\core;


/**
 * In this object we will store the methods that are needed for the project to work.
 */
class coreFunctional{

    /**
     * Method that rounds to thousands and millions
     * (this method will need to be extended at some point)
     */
    public function formatNumber($number){
        if ($number < 1000) {
            return $number;
       }
       if ($number < 1000000) {
           return number_format($number / 1000,1) . 'k';
       }

       if ($number >= 1000000 && $number < 1000000000) {
           return number_format($number / 1000000,1) . 'M';
       }
    }

}


