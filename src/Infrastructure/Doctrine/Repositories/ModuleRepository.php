<?php

declare(strict_types=1);

namespace Rummager\Infrastructure\Doctrine\Repositories;

use Rummager\Service\ModuleRepositoryInterface;
use Rummager\Service\Module\{
    Module,
    ModuleIdentity,
    ModuleName,
    Exceptions\NotExistingModuleException
};

class ModuleRepository extends GeneralRepository implements ModuleRepositoryInterface
{
    /** @throws NotExistingModuleException */
    public function module(ModuleIdentity $moduleId): Module
    {
        $result = $this
            ->entityManager
            ->getRepository(Module::class)
            ->findOneBy(['id' => $moduleId()]);

        if ($result === null) {
            throw NotExistingModuleException::id($moduleId());
        }

        return $result;
    }

    /** @throws NotExistingModuleException */
    public function moduleByName(ModuleName $moduleName): Module
    {
        $result = $this
            ->entityManager
            ->getRepository(Module::class)
            ->findOneBy(['name' => $moduleName()]);

        if ($result === null) {
            throw NotExistingModuleException::name($moduleName());
        }

        return $result;
    }
}
