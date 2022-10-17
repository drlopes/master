<?php

use DI\ContainerBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Alura\CRUD\Helper\EntityManagerCreator;

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions([
    EntityManagerInterface::class => function () {
        return EntityManagerCreator::create();
    }
]);

return $containerBuilder->build();
