<?php

declare(strict_types=1);

namespace Rummager\Service\Module;

use Rummager\Service\ModuleRepositoryInterface;

abstract class ModuleBase
{
    protected $id;

    /** @var  ModuleRepositoryInterface */
    protected $repository;

    public function id()
    {
        return $this->id;
    }

    public function name()
    {
        return $this
            ->repository
            ->module(ModuleIdentity::create($this->id))
            ->getName();
    }
}
