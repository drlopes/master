<?php

namespace Alura\CRUD\Controller;
use Alura\CRUD\Entity\Course;
use Psr\Http\Server\RequestHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\{ServerRequestInterface, ResponseInterface};
use Nyholm\Psr7\Response;

class ListCourses extends HtmlController implements RequestHandlerInterface
{
    private $entityManager;
    private $courseRepo;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->courseRepo = $this->entityManager->getRepository(Course::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->renderHtml(
            'courses/list-courses.php',
            [
                'courses' => $this->courseRepo->findAll(),
                'title' => 'Courses'
            ]
        );

        return new Response(200, [], $html);
    }
}
