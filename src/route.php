<?php

$app->get('/', 'FaucetController:index');
	
$app->get('/auth', 'AuthController:index');

$app->get('/auth/login', 'AuthController:index');


$app->get('/payments', 'PaymentsController:index');

$app->get('/faq', function ($request, $response, $args) {
    return $this->view->render($response, 'faq.twig', ['title' => 'FAQ']);
});
    

