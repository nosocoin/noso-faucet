<?php

namespace NosoProject\Model;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
/**
 * The class that receives the ref wallet and creates cookies, 
 * and then redirects to authorization
 */

final class RefLnksModel {

    public function index(Request $request, Response $response, $args){
        $links = htmlspecialchars($args['refLinks']);
        if(!empty($links))
            setcookie("refer", $links , time() + 3600, "/");   

            return $response->withStatus(302)->withHeader('Location', '/auth');
    }
}