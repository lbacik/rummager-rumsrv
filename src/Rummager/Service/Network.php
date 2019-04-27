<?php

declare(strict_types=1);

namespace Rummager\Service;

use Rummager\Service\Network\Ip;
use Rummager\Service\Network\MaskCidr;
use Rummager\Service\Network\NetworkIdentity;
use Rummager\Service\Network\Ipv4Class;
use Rummager\Service\Network\Status\NetworkStatusIdentity;

class Network
{
    /** @var Ipv4ClassRepositoryInterface */
    private $repository;

    public function __construct(Ipv4ClassRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getNetworkToCheck(): Ipv4Class
    {
        return $this->repository->networkToCheck();
    }

    public function getNetworkAsCidr(int $id): string
    {
        $network = $this->repository->network(NetworkIdentity::create($id));
        return sprintf('%s/%s', $network->getIp(), $network->getMask());
    }

    public function updateStatus(string $netAddr, string $mask, int $newStatusId)
    {
        $network = $this->repository->networkForIpAndMask(Ip::create($netAddr), MaskCidr::create(intval($mask)));
        $status = $this->repository->networkStatus(NetworkStatusIdentity::create($newStatusId));
        $network->setStatus($status);
    }
}
