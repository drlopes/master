<?php

namespace Alura\Cursos\Controller;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Controller\RequestControllerInterface;
use Alura\Cursos\Entity\Course;
use Alura\Cursos\Helper\FlashMessage;

class ControllerDelete implements RequestControllerInterface
{
    private $entityManager;

    function __construct()
    {
        $this->entityManager = EntityManagerCreator::getEntityManager();
    }

    use FlashMessage;

    public function parseRequest(): void
    {
        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        if (is_null($id) || $id === false) {
            header('Location: /list-courses', true, 302);
            return;
        }

        $course = $this->entityManager->getReference(Course::class, $id);
        $this->entityManager->remove($course);
        $this->entityManager->flush();
        $this->flashMessage('Course deleted', 'success');
        header('Location: /list-courses', true, 302);
    }
}
