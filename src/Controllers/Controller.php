<?php

namespace NosoProject\Controllers;

class Controller
{
   protected $container;
   protected $DB;

   public function __construct($container){
       $this->container = $container;
       $this->DB = $container->get('db');
   }
}