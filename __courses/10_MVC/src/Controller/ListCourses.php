<?php

namespace Alura\Cursos\Controller;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Entity\Course;
use Alura\Cursos\Controller\RequestControllerInterface;

class ListCourses extends HtmlController implements RequestControllerInterface
{
    private $courseRepo;

    public function __construct()
    {
        $entityManager = EntityManagerCreator::getEntityManager();
        $this->courseRepo = $entityManager->getRepository(Course::class);
    }

    public function parseRequest(): void
    {
        echo $this->renderHtml(
            'courses/list-courses.php',
            [
                'courses' => $this->courseRepo->findAll(),
                'title' => 'Courses'
            ]
        );
    }
}
