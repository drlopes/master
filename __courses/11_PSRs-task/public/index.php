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

    //Checks the url for the login route
    $isLoginRoute = str_contains($path, 'login');

    //If user is not logged in and url is different from
    //login route, routes to '/login'
    if (!isset($_SESSION['logged']) && !$isLoginRoute) {
        header('Location: /login');
        exit();
    }

    //If user is logged in url path leads to '/login',
    //routes back to '/list-courses'.
    if (isset($_SESSION['logged']) && $isLoginRoute) {
        header('Location: /list-courses');
        exit();
    }

    //Implementation of PSR17 (http factories) for PSR7 (interfaces)
    $psr17Factory = new Psr17Factory;
    $serverRequestCreator = new ServerRequestCreator(
        $psr17Factory, //ServerRequestFactory
        $psr17Factory, //UriFactory
        $psr17Factory, //UploadFileFactory
        $psr17Factory //StreamFactory
    );

    //Instance of Nyholm's serverRequestCreator creates a request from PHP's
    //global variables, such as $_GET, $_POST etc.
    $request = $serverRequestCreator->fromGlobals();

    //Gets name of the apropriate controller class for the given path,
    //instantiates a container from PHP-DI implementation of PSR11 (dependency injection).
    //Container then instantiates the acording class passing the dependencies as
    //configured in './../config/dependencies.php'
    $controller_class = $routes[$path];
    $container = require __DIR__ . '/../config/dependencies.php';
    $controller = $container->get($controller_class);

    //Generates a response compliant with PSR7  by calling the
    //RequestHandlerInterface method 'handle()'
    $response = $controller->handle($request);

    //Appends to the output each pair of header-value from the response
    foreach ($response->getHeaders() as $key => $values) {
        foreach ($values as $value) {
            header("$key: $value", false);
        }
    }

    //Outputs the body of the resulting page
    echo $response->getBody();
}
