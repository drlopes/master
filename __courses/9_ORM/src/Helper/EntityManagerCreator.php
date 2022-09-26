<?php

namespace Alura\Doctrine\Helper;
use Doctrine\ORM\{EntityManager, ORMSetup};


class EntityManagerCreator
{

    public static function createEntityManager(): EntityManager
    {
        // Create a simple "default" Doctrine ORM configuration for Annotations
        $isDevMode = true;
        $proxyDir = null;
        $cache = null;
        $useSimpleAnnotationReader = false;
        $config = ORMSetup::createAttributeMetadataConfiguration(
            [__DIR__ . "/src"],
            $isDevMode,
            $proxyDir,
            $cache
        );

        $conn = [
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/../../db/db.sqlite',
        ];

        return EntityManager::create($conn, $config);
    }
}
