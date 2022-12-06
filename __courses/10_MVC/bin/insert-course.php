<?php

require_once __DIR__ . '/../vendor/autoload.php';
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Entity\Course;

$entityManager = EntityManagerCreator::getEntityManager();

$course = new Course();
$course->setDescription($argv[1]);
$entityManager->persist($course);
$entityManager->flush();
