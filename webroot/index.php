<?php

use Dotenv\Dotenv;
use NosoProject\auth;
use NosoProject\Layout;

include dirname(__DIR__).'/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__).'/config');
$dotenv->load();

$layout = new Layout();
$faucet = new auth();


$layout->headLayout("lool");
$layout->nav();

    switch($_SERVER['REQUEST_URI']) {
        case '/':
           // echo $layout->home();
            break;
        case '/faq':
          //  echo $layout->faq();
            break;
        case '/auth':
                //  echo $layout->faq();
                  break;
        default:
            echo 'This should be a 404';
            break;
    }





    $layout->footer();
?>
