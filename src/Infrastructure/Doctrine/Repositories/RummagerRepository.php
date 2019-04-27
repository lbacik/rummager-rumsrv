<?php

declare(strict_types=1);

namespace Rummager\Infrastructure\Doctrine\Repositories;

use Doctrine\ORM\EntityManagerInterface;
use Rummager\Service\Host\HostEntityFactory;
use Rummager\Service\Host\HostIdentity;
use Rummager\Service\Host\HostValues;
use Rummager\Service\RummagerRepositoryInterface;
use Rummager\Service\Host\Host;
use Rummager\Service\Host\HostName;
use Rummager\Service\Host\Exceptions\NotExistingHostException;
use Rummager\Service\Node;
use Rummager\Service\Host\Node\NodeIdentity;
use Rummager\Service\Host\Node\NodeValues;
use Rummager\Service\Host\Node\NodeEntityFactory;
use Rummager\Service\Host\Node\Exceptions\NotExistingNodeException;
use Rummager\Service\Check;
use Rummager\Service\CheckProcess\CheckIdentity;
use Rummager\Service\CheckProcess\CheckValues;

class RummagerRepository implements RummagerRepositoryInterface
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /** @throws NotExistingHostException */
    public function hostByName(HostName $name): Host
    {
        $result = $this
            ->entityManager
            ->getRepository(Host::class)
            ->findOneBy(['name' => $name()]);

        if ($result === null) {
            throw NotExistingHostException::name($name());
        }

        return $result;
    }

    /** @throws NotExistingHostException */
    public function host(HostIdentity $hostId): Host
    {
        $result = $this
            ->entityManager
            ->getRepository(Host::class)
            ->findOneBy(['id' => $hostId()]);

        if ($result === null) {
            throw NotExistingHostException::id($hostId());
        }

        return $result;
    }

    public function addHost(HostValues $values): Host
    {
        $host = HostEntityFactory::create($values);

        $this->entityManager->persist($host);
        $this->entityManager->flush();

        return $host;
    }

    /** @throws NotExistingNodeException */
    public function node(NodeIdentity $nodeId): Node
    {
        $result = $this
            ->entityManager
            ->getRepository(Node::class)
            ->findOneBy(['id' => $nodeId()]);

        if ($result === null) {
            throw NotExistingNodeException::id($nodeId());
        }

        return $result;
    }

    public function addNode(NodeValues $values): Node
    {
        $node = NodeEntityFactory::create($values);

        $this->entityManager->persist($node);
        $this->entityManager->flush();

        return $node;
    }

    public function addCheck(CheckValues $check): Check
    {
        return new Check();
    }

    public function check(CheckIdentity $checkId): Check
    {
        $result = $this
            ->entityManager
            ->getRepository(Check::class)
            ->findOneBy(['id' => $checkId()]);

        // if ($result === null) {
        //     throw NotExistingNodeException::create();
        // }

        return $result;
    }

    public function getLastIp(): string
    {
    }
}
