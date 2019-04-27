<?php

declare(strict_types=1);

namespace Rummager\Service;

use Rummager\Service\Module\Module as ModuleEntity;
use Rummager\Service\Module\Factory as ModuleFactory;
use Rummager\Service\Module\ModuleIdentity;

class Module
{
    /** @var ModuleFactory */
    private $factory;

    /** @var ModuleRepositoryInterface */
    private $repository;

    public function __construct(
        ModuleFactory $factory,
        ModuleRepositoryInterface $repository
    ) {
        $this->factory = $factory;
        $this->repository = $repository;
    }

    public function get(int $id): ModuleEntity
    {
        $moduleIdentity = ModuleIdentity::create($id);
        return $this->repository->module($moduleIdentity);

    }

    public function moduleIdByName(string $name): int
    {
        return $this
            ->factory
            ->moduleByName($name)
            ->id();
    }

    public function addData(int $moduleId, array $data)
    {
        $this
            ->factory
            ->moduleById($moduleId)
            ->save($data);
    }
}
