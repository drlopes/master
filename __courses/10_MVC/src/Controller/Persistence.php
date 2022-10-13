<?php

namespace Alura\Cursos\Controller;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Entity\Course;
use Alura\Cursos\Controller\RequestControllerInterface;
use Alura\Cursos\Helper\FlashMessage;

class Persistence implements RequestControllerInterface
{
    private $entityManager;

    function __construct()
    {
        $this->entityManager = EntityManagerCreator::getEntityManager();
    }

    use FlashMessage;

    public function parseRequest(): void
    {
        $description = filter_input(
            INPUT_POST,
            'description',
            FILTER_SANITIZE_STRING
        );

        if (!is_null($description) && $description !== false && $description !== '') {
            $course = new Course();
            $course->setDescription($description);

            $id = filter_input(
                INPUT_GET,
                'id',
                FILTER_VALIDATE_INT
            );

            if (!is_null($id) && $id !== false) {
                $course->setId($id);
                $this->entityManager->merge($course);
                $this->flashMessage('Course updated', 'success');
            } else {
                $this->entityManager->persist($course);
                $this->flashMessage('New course added', 'success');
            }
            $this->entityManager->flush();
        }

        header('Location: /list-courses', true, 302);
    }
}
