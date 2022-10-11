<?php

require_once __DIR__ . '/../vendor/autoload.php';
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Entity\Curso;

$entityManager = EntityManagerCreator::getEntityManager();
$course = $entityManager->find(Curso::class, $argv[1]);

$entityManager->remove($course);
$entityManager->flush();
