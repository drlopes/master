<?php

use Alura\Cursos\Controller\{
    ListarCursos,
    FormularioInsercao,
    Persistencia,
    Exclusao,
    FormularioEdicao
};

return [
    '/cursos' => ListarCursos::class,
    '/novo' => FormularioInsercao::class,
    '/salvar-curso' => Persistencia::class,
    '/excluir-curso' => Exclusao::class,
    '/alterar-curso' => FormularioEdicao::class
];
