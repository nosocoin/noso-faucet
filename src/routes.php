<?php

use NosoProject\views\layout;
use NosoProject\views\authView;
use NosoProject\views\faqView;
use NosoProject\views\faucet;
use NosoProject\controllers\authController;




$layout = new Layout();
$layout->headLayout();
$layout->nav();

/**
 * нужно реализовать переопделения 
 * Когда пользователь не аторизован отправлять на авторизацию
 * 
 */

switch($_SERVER['REQUEST_URI']) {
    case '/': //Home Page
      new faucet();
        break;

    case '/auth': //Authorization page
        new authView();
        break;

    case '/auth/login': //Authorization backend
        new authController();                
        break;

  

    case '/faq':
        new faqView();
        break;

    case '/payments':
        break;
    default:
        header("Location: /");
        break;
}

$layout->footer();








