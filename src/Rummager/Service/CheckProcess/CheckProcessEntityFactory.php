<?php

declare(strict_types=1);

namespace Rummager\Service\CheckProcess;

use Rummager\Service\Check as CheckEntity;

class CheckProcessEntityFactory
{
    public static function create(CheckValues $values): CheckEntity
    {
        $entity = new CheckEntity();

        $entity->setNet($values[CheckValues::KEY_NET]);
        $entity->setModule($values[CheckValues::KEY_MODULE]);
        $entity->setNode($values[CheckValues::KEY_NODE]);
        $entity->setCreateTime(new \DateTime());

        return $entity;
    }
}
