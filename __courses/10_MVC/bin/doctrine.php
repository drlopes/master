<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use Alura\Cursos\Infra\EntityManagerCreator;

// replace with file to your own project bootstrap
require_once __DIR__ . '/../vendor/autoload.php';

// replace with mechanism to retrieve EntityManager in your app
$entityManager = EntityManagerCreator::getEntityManager();

ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);
