<?php

use NosoProject\core\layout;
use NosoProject\controllers\auth;
use NosoProject\controllers\faucet;



$layout = new Layout();
$layout->headLayout();
$layout->nav();

switch($_SERVER['REQUEST_URI']) {
    case '/':
    $faucet = new faucet();
    $faucet -> checkAcces();
        break;
    case '/faq':
      

        break;

    case '/auth':
       auth::view();
        break;
    
    case '/auth/login':
 
        auth::post();
            
    break;
    case '/payments':
           
        break;
    default:
        header("Location: /");
        break;
}

$layout->footer();








