<?php

use NosoProject\views\layout;
use NosoProject\views\authView;
use NosoProject\views\faqView;
use NosoProject\views\faucetView;
use NosoProject\views\claimView;
use NosoProject\controllers\authController;

use NosoProject\core\sys\titleGenerator;
use NosoProject\core\sys\Routes;


$layout = new Layout(titleGenerator::output(htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES)));
$layout->nav();



echo "URl ->".$_SERVER['REQUEST_URI']."</br>";

$routes = new Routes();

$routes->add('/', 'lol', true);
$routes->add('/payments','view');
$routes->add('/faq','viewe');

$routes->add('/404','view');

$routes->add('/ref/ada','view');
$routes->run();

/*
switch(htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES)) {
    case '/': //Home Page
        new faucetView();
        break;

    case '/auth': //Authorization page
        new authView();
        break;

    case '/auth/login': //Authorization backend
        new authController();                
        break;

    case '/claim':
        new claimView();
        break;
  

    case '/faq':
        new faqView();
        break;

    case '/payments':
        break;
    default:
        header("Location: /");
        break;
}*/

$layout->footer();








