<?php

$app->get('/', 'FaucetController:index');

$app->get('/auth', 'AuthController:index');
$app->post('/auth/login', 'AuthController:login');

$app->get('/ref/{refLinks}', 'RefLinkController:index');

$app->post('/claim', 'ClaimController:index');
$app->post('/claim/check', 'ClaimController:checkClaim');

$app->get('/payments', 'PaymentsController:index');


$app->get('/faq', function ($request, $response, $args) {
    return $this->view->render($response, 'faq.twig', [
        'title' => 'FAQ',
        'NosoPay' => $this->get('FaucetSettings')['NOSO_PAY'],
        'ViewPayments' => false
    ]);

}); 
$app->get('/adminPage', function ($request, $response, $args) {
    return $this->view->render($response, 'adminPage.twig', [
        'title' => 'Admin Page',
        'ViewPayments' => true,
        'ViewInclud' => 'FaucetSettings'
    ]);

});
