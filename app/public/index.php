<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once(__DIR__.'/../vendor/autoload.php');
require_once(__DIR__.'/../src/config/db.php');

$app = new \Slim\App();

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});

require_once(__DIR__."/../src/utils/UUID.php");

// User Routes
require_once(__DIR__.'/../src/routes/users.php');

// Service Routes
require_once(__DIR__.'/../src/routes/services.php');

// Record Routes
require_once(__DIR__.'/../src/routes/records.php');

$app->run();
