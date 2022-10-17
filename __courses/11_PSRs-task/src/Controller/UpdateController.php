<?php

namespace Alura\CRUD\Controller;
use Alura\CRUD\Entity\Course;
use Psr\Http\Server\RequestHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\{ServerRequestInterface, ResponseInterface};
use Nyholm\Psr7\Response;

class UpdateController extends HtmlController implements RequestHandlerInterface
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
        $queryString = $request->getQueryParams();
        $id = filter_var($queryString['id'], FILTER_VALIDATE_INT);

        if (is_null($id) || $id === false) {
            header('Location: /list-courses');
            quit();
        }

        $course = $this->courseRepo->find($id);
        $title = "Update course " . $course->description();

        $html = $this->renderHtml(
            'courses/form.php',
            [
                'title' => $title,
                'course' => $course
            ]
        );

        return new Response(200, [], $html);
    }
}
