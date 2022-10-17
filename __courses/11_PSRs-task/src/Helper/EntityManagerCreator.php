<?php

namespace Alura\CRUD\Helper;
use Doctrine\ORM\{EntityManager, ORMSetup};

class EntityManagerCreator
{

    public static function create(): EntityManager
    {
        $isDevMode = true;
        $config = ORMSetup::createAttributeMetadataConfiguration(
            [__DIR__ . "/../Entity"],
            $isDevMode
        );

        $conn = [
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/../../db/db.sqlite'
        ];

        return EntityManager::create($conn, $config);
    }
}
