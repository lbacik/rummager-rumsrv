<?php

require_once __DIR__ . "/../../../../../vendor/autoload.php";
require_once __DIR__ . '/../../../../../config/doctrine-bootstrap.php';

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Rummager\Infrastructure\Doctrine\DataFixtures\Ipv4ClassStatusLoader;
use Rummager\Infrastructure\Doctrine\DataFixtures\Ipv4ReservedLoader;
use Rummager\Infrastructure\Doctrine\DataFixtures\ModuleLoader;
use Rummager\Infrastructure\Doctrine\DataFixtures\NodeStatusLoader;
use Rummager\Infrastructure\Doctrine\DataFixtures\SmtpSenderStatusLoader;

$loader = new Loader();

$loader->addFixture(new NodeStatusLoader());
$loader->addFixture(new ModuleLoader());
$loader->addFixture(new SmtpSenderStatusLoader());
$loader->addFixture(new Ipv4ClassStatusLoader());
$loader->addFixture(new Ipv4ReservedLoader());

$purger = new ORMPurger();
$executor = new ORMExecutor($entityManager, $purger);
$executor->execute($loader->getFixtures(), true);
