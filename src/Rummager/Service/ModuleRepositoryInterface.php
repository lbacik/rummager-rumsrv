<?php

declare(strict_types=1);

namespace Rummager\Service;

use Rummager\Service\Module\Exceptions\NotExistingModuleException;
use Rummager\Service\Module\Module;
use Rummager\Service\Module\ModuleIdentity;
use Rummager\Service\Module\ModuleName;

interface ModuleRepositoryInterface
{
    /** @throws NotExistingModuleException */
    public function module(ModuleIdentity $moduleId): Module;

    /** @throws NotExistingModuleException */
    public function moduleByName(ModuleName $moduleName): Module;
}
