<?php

declare(strict_types=1);

namespace Rummager\Behat\Traits;

use Rummager\Service\Check;
use Rummager\Service\CheckProcess\CheckProcessEntityFactory;
use Rummager\Service\CheckProcess\CheckValues;
use Rummager\Service\Host\Node\NodeIdentity;
use Rummager\Service\Module\ModuleIdentity;
use Rummager\Service\Network\NetworkIdentity;

trait CheckTrait
{
    private function newEntity(array $row): Check
    {
        $nodeIdentity = NodeIdentity::create(intval($row['node']));
        $node = $this->repository->node($nodeIdentity);

        $moduleIdentity = ModuleIdentity::create(intval($row['module']));
        $module = $this->moduleRepository->module($moduleIdentity);

        $net = null;
        if (is_int($row['net'])) {
            $netIdentity = NetworkIdentity::create(intval($row['net']));
            $net = $this->networkRepository->network($netIdentity);

        }

        $checkValues = CheckValues::create(
            $node,
            $module,
            $net
        );

        $entity = CheckProcessEntityFactory::create($checkValues);

        return $this->setEntityId($entity, intval($row['id']));
    }
}
