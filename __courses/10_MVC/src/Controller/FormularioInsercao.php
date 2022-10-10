<?php

namespace Alura\Cursos\Controller;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Controller\InterfaceControladorRequisicao;

class FormularioInsercao implements InterfaceControladorRequisicao
{
    public function processaRequisicao(): void
    {
        $title = 'Novo Curso';
        require __DIR__ . '/../../view/courses/formulario-insercao.php';
    }
}
