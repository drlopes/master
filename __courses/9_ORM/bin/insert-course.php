<?php

require_once __DIR__ . '/../vendor/autoload.php';
use Alura\Doctrine\Helper\EntityManagerCreator;
use Alura\Doctrine\Entity\{Student, Phone, Course};

$entityManager = EntityManagerCreator::createEntityManager();

$course = new Course($argv[1]);

$entityManager->persist($course);
$entityManager->flush();
