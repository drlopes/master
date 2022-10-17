<?php

require __DIR__ . '/../vendor/autoload.php';

use Nyholm\Psr7Server\ServerRequestCreator;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Server\RequestHandlerInterface;

$routes = require __DIR__ . '/../config/routes.php';

if (isset($_SERVER['PATH_INFO'])) {

    $path = $_SERVER['PATH_INFO'];

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

    $psr17Factory = new Psr17Factory();

    $creator = new ServerRequestCreator(
        $psr17Factory, //ServerRequestFactory
        $psr17Factory, //UriFactory
        $psr17Factory, //UploadFileFactory
        $psr17Factory //StreamFactory
    );

    $request = $creator->fromGlobals();
    $controllerClassName = $routes[$path];
    $container = require __DIR__ . '/../config/dependencies.php';
    $controller = $container->get($controllerClassName);
    $response = $controller->handle($request);

    foreach ($response->getHeaders() as $name => $values) {
        foreach ($values as $value) {
            header(sprintf('%s: %s', $name, $value), false);
        }
    }

    echo $response->getBody();
}
