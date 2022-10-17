<?php

require __DIR__ . '/../vendor/autoload.php'; //Doctrine project bootstrap

use Psr\Http\Server\RequestHandlerInterface; //Psr7 Interface
use Nyholm\Psr7Server\ServerRequestCreator; //Psr7 Implementation
use Nyholm\Psr7\Factory\Psr17Factory; //Psr7 Implementation

// Checks if the user typed a full url
if (isset($_SERVER['PATH_INFO'])) {
    $routes = require __DIR__ . '/../config/routes.php';
    $path = $_SERVER['PATH_INFO'];
    // If url doesn't exist, send an error 404 message
    if (!array_key_exists($path, $routes)) {
        http_response_code(404);
        exit();
    }

    session_start();

    $isLoginRoute = str_contains($path, 'login');
    if (!isset($_SESSION['logged']) && !$isLoginRoute) {
        header('Location: /login');
        exit();
    }

    $psr17Factory = new Psr17Factory;

    $serverRequestCreator = new ServerRequestCreator(
        $psr17Factory, //ServerRequestFactory
        $psr17Factory, //UriFactory
        $psr17Factory, //UploadFileFactory
        $psr17Factory //StreamFactory
    );

    $request = $serverRequestCreator->fromGlobals();
    $controller_class = $routes[$path];
    $container = require __DIR__ . '/../config/dependencies.php';
    $controller = $container->get($controller_class);
    $response = $controller->handle($request);

    foreach ($response->getHeaders() as $key => $values) {
        foreach ($values as $value) {
            header(sprintf('%s: %s', $key, $value), false);
        }
    }

    echo $response->getBody();
}
