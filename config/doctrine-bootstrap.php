<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$isDevMode = true;
$paths = [ __DIR__ . "/../src/Infrastructure/Doctrine"];

$config = Setup::createYAMLMetadataConfiguration($paths, $isDevMode);

$conn = [
    'url' => 'mysql://root:root@mysql/rumsrv',
];

$entityManager = EntityManager::create($conn, $config);
