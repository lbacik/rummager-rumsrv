<?php

declare(strict_types=1);

namespace Rummager\Behat\Base;

use Behat\Behat\Context\Context;
use Doctrine\ORM\EntityManagerInterface;
use Rummager\Infrastructure\Doctrine\Repositories\ModuleRepository;
use Rummager\Infrastructure\Doctrine\Repositories\CheckProcessRepository;
use Rummager\Infrastructure\Doctrine\Repositories\ModuleSmtpRepository;
use Rummager\Infrastructure\Doctrine\Repositories\Ipv4ClassRepository;
use Rummager\Infrastructure\Doctrine\Repositories\RummagerRepository;
use Rummager\Service\CheckProcess\CheckProcessEntityFactory;

class ServiceFactory implements Context
{
    /** @var mixed */
    private $value;

    public function entityManager(): EntityManagerInterface
    {
        return require __DIR__ . '/../../config/doctrine-bootstrap.php';
    }

    /**
     * @return mixed
     */
    public function repository(string $name, EntityManagerInterface $em)
    {
        switch ($name) {
            case 'rummager':
                return new RummagerRepository($em);
            case 'module':
                return new ModuleRepository($em);
            case 'network':
                return new Ipv4ClassRepository($em);
            case 'check':
                return new CheckProcessRepository($em, CheckProcessEntityFactory::class);
            case 'moduleSmtp':
                return new ModuleSmtpRepository($em);
        }
    }
}
