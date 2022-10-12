<?php

namespace Alura\Cursos\Controller;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Entity\Curso;

class FormularioEdicao extends ControllerComHtml implements InterfaceControladorRequisicao
{
    private $entityManager;
    private $courseRepository;

    public function __construct()
    {
        $this->entityManager = EntityManagerCreator::getEntityManager();
        $this->courseRepository = $this->entityManager->getRepository(Curso::class);
    }
    public function processaRequisicao(): void
    {
        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        if (is_null($id) || $id === false) {
            header('Location: /listar-cursos');
            return;
        }

        $course = $this->courseRepository->find($id);
        $title = "Alterar curso " . $course->getDescricao();

        $this->renderizaHtml(
            'courses/formulario.php',
            [
                'title' => $title,
                'course' => $course
            ]
        );
    }
}
