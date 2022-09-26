<?php

require 'vendor/autoload.php';
use Alura\Doctrine\Helper\EntityManagerCreator;

$entityManager = EntityManagerCreator::createEntityManager();
var_dump($entityManager);
