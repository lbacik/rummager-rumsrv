<?php

declare(strict_types=1);

namespace Rummager\Behat\Traits;

use Rummager\Service\Network\Ipv4ClassStatus;

trait NetworkStatusTrait
{
    private function newEntity(array $row): Ipv4ClassStatus
    {
        $entity = new Ipv4ClassStatus();
        $entity->setId($row['id']);
        $entity->setName($row['name']);
        return $entity;
    }
}
