<?php


$app->get('/', function ($request, $response, $args) {
    return $response->write("Hello " . $args['name']);
});

//	$app->get('/', 'HomeController:index');
	
