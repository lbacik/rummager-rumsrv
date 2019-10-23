<?php

declare(strict_types=1);

namespace Rummager\Service\Module;

use Psr\Container\ContainerInterface;
use Rummager\Service\ModuleRepositoryInterface;

class Factory
{
    /** @var ModuleRepositoryInterface */
    private $repository;

    /** @var ContainerInterface */
    private $serviceProvider;

    public function __construct(
        ModuleRepositoryInterface $repository,
        ContainerInterface $serviceProvider
    ) {
        $this->repository = $repository;
        $this->serviceProvider = $serviceProvider;
    }

    public function moduleById(int $id): ModuleBase
    {
        $moduleIdentity = ModuleIdentity::create($id);
        $moduleEntity = $this->repository->module($moduleIdentity);
        $module = $this->serviceProvider->get($moduleEntity->getName());
        return $module;
    }

    public function moduleByName(string $name): ModuleBase
    {
        $moduleName = ModuleName::create($name);
        $module = $this->serviceProvider->get($moduleName());
        return $module;
    }
}
