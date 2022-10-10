<?php

require __DIR__ . '/../vendor/autoload.php';

use Alura\Cursos\Controller\{ListarCursos, FormularioInsercao};

if (isset($_SERVER['PATH_INFO'])) {
    switch ($_SERVER['PATH_INFO']) {
        case '/cursos':
            $controller = new ListarCursos();
            $controller->processaRequisicao();
            break;

        case '/novo':
            $controller = new FormularioInsercao();
            $controller->processaRequisicao();
            break;

        default:
            $path = $_SERVER['PATH_INFO'];
            echo "Error 404: page \"$path\" not found or nonexistent.";
            break;
    }
}
