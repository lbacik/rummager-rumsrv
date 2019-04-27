<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once __DIR__ . "/../../vendor/autoload.php";

$isDevMode = true;
$paths = ["/project/src/Infrastructure/Doctrine"];

$config = Setup::createYAMLMetadataConfiguration($paths, $isDevMode);

$db = 'sqlite:/' . __DIR__ . '/../../var/db.sqlite';

$conn = [
    'url' => $db,
];

$entityManager = EntityManager::create($conn, $config);

return $entityManager;
