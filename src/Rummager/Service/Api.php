<?php

declare(strict_types=1);

namespace Rummager\Service;

use Psr\Container\ContainerInterface;

class Api
{
    /** @var ContainerInterface */
    private $serviceProvider;

    public function __construct(ContainerInterface $serviceProvider)
    {
        $this->serviceProvider = $serviceProvider;
    }

    public function getHostId(string $name): int
    {
        return $this
            ->serviceProvider
            ->get('host')
            ->hostIdByName($name);
    }

    public function getNodesRunning(int $hostId): int
    {
        return $this
            ->serviceProvider
            ->get('host')
            ->nodesRunning($hostId);
    }

    public function getHostMaxNodes(int $hostId): int
    {
        return $this
            ->serviceProvider
            ->get('host')
            ->getMaxNodes($hostId);
    }

    public function getHostMaxThreads(int $hostId): int
    {
        return $this
            ->serviceProvider
            ->get('host')
            ->getMaxThreads($hostId);
    }

    public function checkNodeIsRunning(int $nodeId): bool
    {
        return $this
            ->serviceProvider
            ->get('host')
            ->checkNodeIsRunning($nodeId);
    }

    public function getNewNodeId(int $hostId): int
    {
        return $this
            ->serviceProvider
            ->get('host')
            ->getNewNodeId($hostId);
    }

    public function getNetwork(int $networkId): string
    {
        return $this
            ->serviceProvider
            ->get('network')
            ->getNetworkAsCidr($networkId);
    }

    public function getLastIp(string $ip, string $brd): string
    {
        return $this
            ->serviceProvider
            ->get('smtp')
            ->lastIp($ip, $brd);
    }

    public function updateNetworkStatus(string $netAddr, string $mask, int $newStatus): void
    {
        $this
            ->serviceProvider
            ->get('network')
            ->updateStatus($netAddr, $mask, $newStatus);
    }

    public function startNewCheck(int $nodeId, int $moduleId): int
    {
        return $this
            ->serviceProvider
            ->get('checkProcess')
            ->startNew($nodeId, $moduleId);
    }

    public function getNetworkId(int $checkId)
    {
        return $this
            ->serviceProvider
            ->get('checkProcess')
            ->getNetworkId($checkId);
    }

    public function getModuleId(string $name): int
    {
        return $this
            ->serviceProvider
            ->get('module')
            ->moduleIdByName($name);
    }

    public function addHostInfo(array $data): void
    {
        $moduleId = $this
            ->serviceProvider
            ->get('checkProcess')
            ->getModuleId($data['checkId']);

        $this
            ->serviceProvider
            ->get('module')
            ->addData($moduleId, $data);
    }
}
