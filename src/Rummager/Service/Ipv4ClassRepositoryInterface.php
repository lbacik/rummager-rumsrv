<?php

declare(strict_types=1);

namespace Rummager\Service;

use Rummager\Service\Network\Ip;
use Rummager\Service\Network\Ipv4Class;
use Rummager\Service\Network\Ipv4ClassStatus;
use Rummager\Service\Network\MaskCidr;
use Rummager\Service\Network\NetworkIdentity;
use Rummager\Service\Network\Status\NetworkStatusIdentity;

interface Ipv4ClassRepositoryInterface
{
    public function network(NetworkIdentity $networkId): Ipv4Class;
    public function networkStatus(NetworkStatusIdentity $statusId): Ipv4ClassStatus;
    public function networkToCheck(): Ipv4Class;
    public function updateNetworkStatus(Ipv4Class $network, Ipv4ClassStatus $status): void;
    public function networkForIpAndMask(Ip $ip, MaskCidr $mask): Ipv4Class;
}
