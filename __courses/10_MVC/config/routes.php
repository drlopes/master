<?php

use Alura\Cursos\Controller\ListarCursos;
use Alura\Cursos\Controller\FormularioInsercao;
use Alura\Cursos\Controller\Persistencia;
use Alura\Cursos\Controller\Exclusao;

return [
    '/cursos' => ListarCursos::class,
    '/novo' => FormularioInsercao::class,
    '/salvar-curso' => Persistencia::class,
    '/excluir-curso' => Exclusao::class
];
