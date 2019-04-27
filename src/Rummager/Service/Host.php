<?php

declare(strict_types=1);

namespace Rummager\Service;

use Rummager\Service\Host\HostName;
use Rummager\Service\Host\HostValues;
use Rummager\Service\Host\HostIdentity;
use Rummager\Service\Host\Node\Status as NodeStatus;
use Rummager\Service\Host\Node\NodeIdentity;
use Rummager\Service\Host\Node\NodeValues;
use Rummager\Service\Host\Exceptions\NotExistingHostException;

class Host
{
    /** @var RummagerRepositoryInterface */
    private $repository;

    public function __construct(RummagerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function hostIdByName(string $name): int
    {
        $hostname = HostName::create($name);

        try {
            $host = $this->repository->hostByName($hostname);
        } catch (NotExistingHostException $exception) {
            $vo = HostValues::create($hostname);
            $host = $this->repository->addHost($vo);
        }

        return $host->getId();
    }

    public function nodesRunning(int $hostId): int
    {
        $host = $this->repository->host(HostIdentity::create($hostId));
        $result = $host
            ->getNodes()
            ->filter(function (Node $item) {
                if ($item->getStatus() !== null
                    && $item->getStatus()->getId() === NodeStatus::RUNNING
                ) {
                    return true;
                }
                return false;
            })
            ->count();
        return $result;
    }

    public function getMaxNodes(int $hostId): int
    {
        $host = $this->repository->host(HostIdentity::create($hostId));
        return $host->getN();
    }

    public function getMaxThreads(int $hostId): int
    {
        $host = $this->repository->host(HostIdentity::create($hostId));
        return $host->getT();
    }

    public function checkNodeIsRunning(int $nodeId): bool
    {
        $node = $this->repository->node(NodeIdentity::create($nodeId));

        // FIXME: code duplication
        if ($node->getStatus() !== null
            && $node->getStatus()->getId() === NodeStatus::RUNNING
        ) {
            return true;
        }
        return false;
    }

    public function getNewNodeId(int $hostId): int
    {
        $host = $this->repository->host(HostIdentity::create($hostId));
        $node = $this->repository->addNode(NodeValues::create($host));
        return $node->getId();
    }

    public function worker(int $workerId): Node
    {
     return $this->repository->node(NodeIdentity::create($workerId));
    }
}
