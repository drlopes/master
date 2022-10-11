<?php

require __DIR__ . '/../vendor/autoload.php';

$routes = require __DIR__ . '/../config/routes.php';

if (isset($_SERVER['PATH_INFO'])) {

    $path = $_SERVER['PATH_INFO'];

    if (!array_key_exists($path, $routes)) {
        http_response_code(404);
        exit();
    }

    $controllerClassName = $routes[$path];
    $controller = new $controllerClassName;
    $controller->processaRequisicao();
}
