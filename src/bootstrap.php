<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';

$entitiesPath = [__DIR__ . '/Blog/Entity'];

$config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($entitiesPath, $dev);
$entityManager = \Doctrine\ORM\EntityManager::create($dbParams, $config);
