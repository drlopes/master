<?php

namespace Alura\CRUD\Controller;
use Alura\CRUD\Utility\EntityManagerCreator;
use Alura\CRUD\Entity\Course;
use Alura\CRUD\Helper\FlashMessage;
use Psr\Http\Server\RequestHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\{ServerRequestInterface, ResponseInterface};
use Nyholm\Psr7\Response;

class Persistence implements RequestHandlerInterface
{
    private $entityManager;

    function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    use FlashMessage;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $parsedBody = $request->getParsedBody();
        $description = $parsedBody['description'];

        // Checks for an empty 'description' value.
        // Routes back to /new-entry with flash message.
        if ($description === '') {
            $this->flashMessage('Invalid description for course.', 'danger');
            return new Response(302, ['Location' => '/new-entry']);
            quit();
        }

        if (!is_null($description) && $description !== false) {
            $course = new Course();
            $course->setDescription($description);

            $queryParams = $request->getQueryParams();
            $id = filter_var($queryParams['id'], FILTER_VALIDATE_INT);

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

        return new Response(302, ['Location' => '/list-courses']);
        quit();
    }
}
