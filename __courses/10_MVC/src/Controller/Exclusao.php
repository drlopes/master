<?php

namespace Alura\Cursos\Controller;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Controller\InterfaceControladorRequisicao;
use Alura\Cursos\Entity\Curso;

class Exclusao implements InterfaceControladorRequisicao
{
    private $entityManager;

    function __construct()
    {
        $this->entityManager = EntityManagerCreator::getEntityManager();
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        if (is_null($id) || $id === false) {
            header('Location: /cursos', true, 302);
            return;
        }

        $course = $this->entityManager->getReference(Curso::class, $id);
        $this->entityManager->remove($course);
        $this->entityManager->flush();
        header('Location: /cursos', true, 302);
    }
}
