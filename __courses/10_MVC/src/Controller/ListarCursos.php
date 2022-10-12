<?php

namespace Alura\Cursos\Controller;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Controller\InterfaceControladorRequisicao;

class ListarCursos extends ControllerComHtml implements InterfaceControladorRequisicao
{
    private $repositorioDeCursos;

    public function __construct()
    {
        $entityManager = EntityManagerCreator::getEntityManager();
        $this->repositorioDeCursos = $entityManager->getRepository(Curso::class);
    }

    public function processaRequisicao(): void
    {
        $this->renderizaHtml(
            'courses/listar-cursos.php',
            [
                'cursos' => $this->repositorioDeCursos->findAll(),
                'title' => 'Listar Cursos'
            ]
        );
    }
}
