<?php

declare(strict_types=1);

namespace Rummager\Service;

use Rummager\Service\Host\Host;
use Rummager\Service\Host\HostIdentity;
use Rummager\Service\Host\HostValues;
use Rummager\Service\Host\HostName;
use Rummager\Service\Host\Exceptions\NotExistingHostException;
use Rummager\Service\Host\Node\Exceptions\NotExistingNodeException;
use Rummager\Service\Host\Node\NodeIdentity;
use Rummager\Service\Host\Node\NodeValues;

interface RummagerRepositoryInterface
{
    /** @throws NotExistingHostException */
    public function hostByName(HostName $name): Host;

    /** @throws NotExistingHostException */
    public function host(HostIdentity $hostId): Host;

    public function addHost(HostValues $host): Host;

    /** @throws NotExistingNodeException */
    public function node(NodeIdentity $hostId): Node;

    public function addNode(NodeValues $node): Node;

    public function getLastIp(): string;
}
