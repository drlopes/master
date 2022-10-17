<?php

namespace Alura\CRUD\Controller;
use Alura\CRUD\Entity\Course;
use Psr\Http\Server\RequestHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\{ServerRequestInterface, ResponseInterface};
use Nyholm\Psr7\Response;
use Alura\CRUD\Helper\FlashMessage;

class DeleteController implements RequestHandlerInterface
{
    private $entityManager;

    function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    use FlashMessage;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $id = $queryParams['id'];

        if (is_null($id) || $id === false) {
            header('Location: /list-courses', TRUE, 302);
            quit();
        }

        $course = $this->entityManager->getReference(Course::class, $id);
        $this->entityManager->remove($course);
        $this->entityManager->flush();
        $this->flashMessage('Course deleted', 'success');
        return new Response(302, ['Location' => '/list-courses']);
        quit();
    }
}
