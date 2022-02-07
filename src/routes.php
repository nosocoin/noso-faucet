<?php

use NosoProject\views\authView;
use NosoProject\views\faucetView;
use NosoProject\views\claimView;
use NosoProject\controllers\authController;
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

    $routes->add('/payments','view');

    $routes->add('/faq', function() {
            new faqView();
            });

    $routes->add('/404', function() { notFoundView::view();  });

    $routes->add('/ref','view');

    $routes->add('/claim', function() {
            new claimView(); 
            });

    $routes->add('/auth/login', function() {
            new authController();      
            });

    $routes->add('/auth', function() {
            new authView();
             });

    $routes->run();


    $layout->footer();








