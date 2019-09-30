<?php

declare(strict_types=1);

namespace Rummager\Infrastructure;

use Doctrine\ORM\EntityManager;
use Pimple\Psr11\Container;
use Rummager\Infrastructure\Doctrine\Repositories\CheckProcessRepository;
use Rummager\Infrastructure\Doctrine\Repositories\Ipv4ClassRepository;
use Rummager\Infrastructure\Doctrine\Repositories\ModuleRepository;
use Rummager\Infrastructure\Doctrine\Repositories\ModuleSmtpRepository;
use Rummager\Infrastructure\Doctrine\Repositories\RummagerRepository;
use Rummager\Service\Api;
use Rummager\Service\CheckProcess;
use Rummager\Service\Host;
use Rummager\Service\Module;
use Rummager\Service\Module\Smtp\Smtp;
use Rummager\Service\Network;

class ServiceApiFactory
{
    public static function create(EntityManager $entityManager): Api
    {
        $pimple = new \Pimple\Container();
        static::createServices($pimple, $entityManager);
        $container = new Container($pimple);
        return new Api($container);
    }

    protected static function createServices(\Pimple\Container $container, EntityManager $entityManager): void
    {
        $container['repository'] = function () use ($entityManager) {
            return new RummagerRepository($entityManager);
        };

        $container['repository.ipv4class'] = function () use ($entityManager) {
            return new Ipv4ClassRepository($entityManager);
        };

        $container['repository.module'] = function () use ($entityManager) {
            return new ModuleRepository($entityManager);
        };

        $container['repository.module.smtp'] = function () use ($entityManager) {
            return new ModuleSmtpRepository($entityManager);
        };

        $container['repository.checkprocess'] = function () use ($entityManager) {
            return new CheckProcessRepository(
                $entityManager,
                CheckProcess\CheckProcessEntityFactory::class
            );
        };

        $container['module.factory'] = function ($c) {
            return new Module\Factory($c['repository.module'], $c);
        };

        $container['host'] = function ($c) {
            return new Host($c['repository']);
        };

        $container['network'] = function ($c) {
            return new Network($c['repository.ipv4class']);
        };

        $container['smtp'] = function ($c) {
            return new Smtp($c['repository.module.smtp']);
        };

        $container['module'] = function ($c) {
            return new Module($c['module.factory'], $c['repository.module']);
        };

        $container['checkProcess'] = function ($c) {
            return new CheckProcess(
                $c['repository.checkprocess'],
                $c['host'],
                $c['module']
            );
        };
    }
}
