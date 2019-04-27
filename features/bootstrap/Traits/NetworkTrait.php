<?php

declare(strict_types=1);

namespace Rummager\Behat\Traits;

use Rummager\Service\Network\Ipv4Class;
use Rummager\Service\Network\Ipv4Values;
use Rummager\Service\Network\Status\NetworkStatusIdentity;

trait NetworkTrait
{
    private function newEntity(array $row): Ipv4Class
    {
        $status = $this->repository->networkStatus(NetworkStatusIdentity::create(intval($row['status'])));

        $values = Ipv4Values::create(
            $row['ip'],
            $row['mask'],
            $row['description'],
            $status
        );

        $entity = new Ipv4Class();
        $entity->setIp($values['ip']);
        $entity->setMask($values['mask']);
        $entity->setDescription($values['description']);
        $entity->setStatus($status);
        $entity = $this->setEntityId($entity, intval($row['id']));
        return $entity;
    }
}
