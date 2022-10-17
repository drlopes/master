<?php

namespace Alura\CRUD\Controller;
use Alura\CRUD\Entity\Course;
use Psr\Http\Server\RequestHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\{ServerRequestInterface, ResponseInterface};
use Nyholm\Psr7\Response;

class XmlCourse implements RequestHandlerInterface
{
    private $courseRepo;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->courseRepo = $entityManager->getRepository(Course::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $courses = $this->courseRepo->findAll();
        $coursesInXml = new \SimpleXMLElement('<courses/>');

        foreach ($courses as $course) {
            $courseInXml = $coursesInXml->addChild('course');
            $courseInXml->addChild('id', $course->id());
            $courseInXml->addChild('description', htmlspecialchars($course->description()));
        }

        return new Response(200, ['Content-Type' => 'application/xml'], $coursesInXml->asXML());
        quit();
    }
}
