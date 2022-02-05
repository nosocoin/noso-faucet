<?php

use NosoProject\core\layout;
use NosoProject\views\authView;
use NosoProject\controllers\authController;
use NosoProject\controllers\faucet;



$layout = new Layout();
$layout->headLayout();
$layout->nav();

switch($_SERVER['REQUEST_URI']) {
    case '/':
    $faucet = new faucet();
    $faucet -> checkAcces();
        break;

    case '/auth':
        new authView();
        break;

    case '/auth/login':
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








