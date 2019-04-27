<?php

declare(strict_types=1);

namespace Rummager\Service;

class Api
{
    /** @var ServiceProviderInterface */
    private $serviceProvider;

    public function __construct(ServiceProviderInterface $serviceProvider)
    {
        $this->serviceProvider = $serviceProvider;
    }

    public function getHostID(string $name): int
    {
        return $this
            ->serviceProvider['host']
            ->hostIdByName($name);
    }

    public function getNodesRunning(int $hostId): int
    {
        return $this
            ->serviceProvider['host']
            ->nodesRunning($hostId);
    }

    public function getHostMaxNodes(int $hostId): int
    {
        return $this
            ->serviceProvider['host']
            ->getMaxNodes($hostId);
    }

    public function getHostMaxThreads(int $hostId): int
    {
        return $this
            ->serviceProvider['host']
            ->getMaxThreads($hostId);
    }

    public function checkNodeIsRunning(int $nodeId): bool
    {
        return $this
            ->serviceProvider['host']
            ->checkNodeIsRunning($nodeId);
    }

    public function getNewNodeId(int $hostId): int
    {
        return $this
            ->serviceProvider['host']
            ->getNewNodeId($hostId);
    }

    public function getNetwork(int $networkId): string
    {
        return $this
            ->serviceProvider['network']
            ->getNetworkAsCidr($networkId);
    }

    public function getLastIp(string $ip, string $brd): string
    {
        return $this
            ->serviceProvider['smtp']
            ->lastIp($ip, $brd);
    }

    public function updateNetworkStatus(string $netAddr, string $mask, int $newStatus): void
    {
        $this
            ->serviceProvider['network']
            ->updateStatus($netAddr, $mask, $newStatus);
    }

    public function startNewCheck(int $nodeId, int $moduleId): int
    {
        return $this
            ->serviceProvider['checkProcess']
            ->startNew($nodeId, $moduleId);
    }

    public function getNetworkId(int $checkId)
    {
        return $this
            ->serviceProvider['checkProcess']
            ->getNetworkId($checkId);
    }

    public function getModuleId(string $name): int
    {
        return $this
            ->serviceProvider['module']
            ->moduleIdByName($name);
    }

    public function addHostInfo(array $data)
    {
        $moduleId = $this
            ->serviceProvider['checkProcess']
            ->getModuleId($data['checkId']);

        $this
            ->serviceProvider['module']
            ->addData($moduleId, $data);
    }
}
