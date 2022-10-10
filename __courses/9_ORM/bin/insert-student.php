<?php

require_once __DIR__ . '/../vendor/autoload.php';
use Alura\Doctrine\Helper\EntityManagerCreator;
use Alura\Doctrine\Entity\{Student, Phone};

$entityManager = EntityManagerCreator::createEntityManager();

$student = new Student('Daniel Rodrigues');
$student->addPhone(new Phone('(35) 9 9882-6872'));
$student->addPhone(new Phone('(35) 9 8403-8633'));

$entityManager->persist($student);
$entityManager->flush();
