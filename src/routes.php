<?php


use NosoProject\controllers\authController;
use NosoProject\controllers\refController;
use NosoProject\views\authView;
use NosoProject\views\faucetView;
use NosoProject\views\claimView;
use NosoProject\views\faqView;
use NosoProject\views\layout;
use NosoProject\views\notFoundView;

use NosoProject\core\sys\titleGenerator;
use NosoProject\core\sys\Routes;


    $layout = new Layout(titleGenerator::output(htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES)));
    $layout->nav();



    $routes = new Routes();
    $routes->add('/',  function() {
            new faucetView();
            }, true);

    $routes->add('/payments',function() {});

    $routes->add('/faq', function() {
            new faqView();
            });

  

    $routes->add('/ref/[$]',function($variable) {
           $refController = new refController($variable);
           $refController->run();
    });

    $routes->add('/claim', function() {
            new claimView(); 
            });

    $routes->add('/auth/login', function() {
            new authController();      
            });

    $routes->add('/auth', function() {
            new authView();
             });

    $routes->add('/404', function() { notFoundView::view();  });
    $routes->run();

    $layout->footer();








