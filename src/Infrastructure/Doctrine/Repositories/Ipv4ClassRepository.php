<?php

declare(strict_types=1);

namespace Rummager\Infrastructure\Doctrine\Repositories;

use Rummager\Service\Network;
use Rummager\Service\Network\Exceptions\NoNetworkToCheckException;
use Rummager\Service\Network\Exceptions\NotExistingNetworkException;
use Rummager\Service\Network\Exceptions\NotExistingNetworkStatusException;
use Rummager\Service\Network\Ip;
use Rummager\Service\Network\Ipv4Class;
use Rummager\Service\Network\Ipv4ClassStatus;
use Rummager\Service\Network\MaskCidr;
use Rummager\Service\Network\NetworkIdentity;
use Rummager\Service\Network\Status\NetworkStatusIdentity;
use Rummager\Service\Ipv4ClassRepositoryInterface;

class Ipv4ClassRepository extends GeneralRepository implements Ipv4ClassRepositoryInterface
{
    public function network(NetworkIdentity $networkId): Ipv4Class
    {
        $result = $this
            ->entityManager
            ->getRepository(Ipv4Class::class)
            ->findOneBy(['id' => $networkId()]);

        if ($result === null) {
            throw NotExistingNetworkException::id($networkId());
        }

        return $result;
    }

    public function networkStatus(NetworkStatusIdentity $statusId): Ipv4ClassStatus
    {
        $result = $this
            ->entityManager
            ->getRepository(Ipv4ClassStatus::class)
            ->findOneBy(['id' => $statusId()]);

        if ($result === null) {
            throw NotExistingNetworkStatusException::create();
        }

        return $result;
    }

    public function networkToCheck(): Ipv4Class
    {
        $statusTodo = $this->networkStatus(
            NetworkStatusIdentity::create(Network\Status::STATUS_TODO)
        );

        $result = $this->entityManager
            ->getRepository(Ipv4Class::class)
            ->findOneBy(['status' => $statusTodo]);

        if ($result === null) {
            throw NoNetworkToCheckException::create();
        }

        return $result;
    }

    public function updateNetworkStatus(Ipv4Class $network, Ipv4ClassStatus $status): void
    {
        $network->setStatus($status);

        $this->entityManager->persist($network);
        $this->entityManager->flush();
    }

    public function networkForIpAndMask(Ip $ip, MaskCidr $mask): Ipv4Class
    {
        $result = $this->entityManager
            ->getRepository(Ipv4Class::class)
            ->findOneBy([
                'ip' => $ip(),
                'mask' => $mask(),
            ]);

        if ($result === null) {
            throw NotExistingNetworkException::address($ip(), $mask());
        }

        return $result;
    }
}
