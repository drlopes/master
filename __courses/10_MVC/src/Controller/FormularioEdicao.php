<?php

namespace Alura\Cursos\Controller;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Controller\InterfaceControladorRequisicao;


class FormularioEdicao implements InterfaceControladorRequisicao
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

        require __DIR__ . '/../../view/courses/formulario.php';
    }
}