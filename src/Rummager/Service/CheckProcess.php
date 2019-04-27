<?php

declare(strict_types=1);

namespace Rummager\Service;

use Rummager\Service\CheckProcess\CheckValues;
use Rummager\Service\CheckProcess\CheckIdentity;
use Rummager\Service\CheckProcess\Exceptions\NetworkNotAvailableException;

class CheckProcess
{
    /** @var CheckProcessRepositoryInterface */
    private $repository;

    /** @var Host */
    private $host;

    /** @var Module */
    private $module;

    public function __construct(
        CheckProcessRepositoryInterface $repository,
        Host $host,
        Module $module
    ) {
        $this->repository = $repository;
        $this->host = $host;
        $this->module = $module;
    }

    public function startNew(int $nodeId, int $moduleId): int
    {
        $node = $this->host->worker($nodeId);
        $module = $this->module->get($moduleId);

        $checkValues = CheckValues::create($node, $module);
        $check = $this->repository->add($checkValues);

        return $check->getId();
    }

    public function getNetworkId(int $checkId): int
    {
        $check = $this->repository->get(CheckIdentity::create($checkId));

        if (($network = $check->getNet()) === null) {
            throw NetworkNotAvailableException::create($checkId);
        }

        return $network->getId();
    }

    public function getModuleId(int $checkId): int
    {
        return $this
            ->repository
            ->get(CheckIdentity::create($checkId))
            ->getModule()
            ->getId();
    }
}
