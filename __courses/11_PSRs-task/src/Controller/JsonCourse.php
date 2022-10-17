<?php

namespace Alura\CRUD\Controller;
use Alura\CRUD\Entity\Course;
use Psr\Http\Server\RequestHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\{ServerRequestInterface, ResponseInterface};
use Nyholm\Psr7\Response;

class JsonCourse implements RequestHandlerInterface
{
    private $courseRepo;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->courseRepo = $entityManager->getRepository(Course::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $courses = $this->courseRepo->findAll();
        return new Response(200, ['Content-Type' => 'application/json'], json_encode($courses));
    }
}
