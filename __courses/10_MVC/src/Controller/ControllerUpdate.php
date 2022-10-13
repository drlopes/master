<?php

namespace Alura\Cursos\Controller;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Entity\Course;

class ControllerUpdate extends HtmlController implements RequestControllerInterface
{
    private $entityManager;
    private $courseRepo;

    public function __construct()
    {
        $this->entityManager = EntityManagerCreator::getEntityManager();
        $this->courseRepo = $this->entityManager->getRepository(Course::class);
    }
    public function parseRequest(): void
    {
        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        if (is_null($id) || $id === false) {
            header('Location: /list-courses');
            return;
        }

        $course = $this->courseRepo->find($id);
        $title = "Update course " . $course->getDescription();

        echo $this->renderHtml(
            'courses/form.php',
            [
                'title' => $title,
                'course' => $course
            ]
        );
    }
}
