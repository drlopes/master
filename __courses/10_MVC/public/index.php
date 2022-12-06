<?php

if (isset($_SERVER['PATH_INFO'])) {

    require __DIR__ . '/../vendor/autoload.php';

    $routes = require __DIR__ . '/../config/routes.php';

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

    $controllerClassName = $routes[$path];
    $controller = new $controllerClassName;
    $controller->parseRequest();
}