<?php

use NosoProject\views\layout;
use NosoProject\views\authView;
use NosoProject\controllers\authController;
use NosoProject\controllers\faucet;



$layout = new Layout();
$layout->headLayout();
$layout->nav();

switch($_SERVER['REQUEST_URI']) {
    case '/': //Home Page
    $faucet = new faucet();
    $faucet -> checkAcces();
        break;

    case '/auth': //Authorization page
        new authView();
        break;

    case '/auth/login': //Authorization backend
        new authController();                
        break;

  

    case '/faq':
        break;

    case '/payments':
        break;
    default:
        header("Location: /");
        break;
}

$layout->footer();








