<?php

require_once __DIR__ . '/../vendor/autoload.php';
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Entity\Curso;

$entityManager = EntityManagerCreator::getEntityManager();

$course = new Curso();
$course->setDescricao($argv[1]);
$entityManager->persist($course);
$entityManager->flush();
