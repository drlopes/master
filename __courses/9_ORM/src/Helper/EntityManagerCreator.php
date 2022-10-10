<?php

namespace Alura\Doctrine\Helper;
use Doctrine\ORM\{EntityManager, ORMSetup};


class EntityManagerCreator
{

    public static function createEntityManager(): EntityManager
    {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            [__DIR__ . "/.."],
            true
        );

        $conn = [
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/../../db/db.sqlite'
        ];

        return EntityManager::create($conn, $config);
    }
}
