<?php

declare(strict_types=1);

namespace spec\Rummager\Service;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Rummager\Service\Host;
use Rummager\Service\RummagerRepositoryInterface;
use Rummager\Service\Host\Host as HostEntity;
use Rummager\Service\Host\HostName;
use Rummager\Service\Host\HostIdentity;
use Rummager\Service\Host\HostValues;
use Rummager\Service\Node as NodeEntity;
use Rummager\Service\NodeStatus;
use Rummager\Service\Host\Node\NodeIdentity;
use Rummager\Service\Host\Node\NodeValues;
use Rummager\Service\Host\Exceptions\NotExistingHostException;
use Doctrine\Common\Collections\ArrayCollection as Collection;

class HostSpec extends ObjectBehavior
{
    const HOST_ID = 10;
    const NODE_ID = 123;

    public function let(
        RummagerRepositoryInterface $repository,
        HostEntity $hostEntity
    ) {
        $this->beConstructedWith($repository);

        $hostEntity->getId()->willReturn(self::HOST_ID);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Host::class);
    }

    public function it_returns_host_id(
        RummagerRepositoryInterface $repository,
        HostEntity $hostEntity
    ) {
        $repository
            ->hostByName(Argument::type(HostName::class))
            ->willReturn($hostEntity);

        $this->hostIdByName('example.com')->shouldReturn(self::HOST_ID);
    }

    public function it_creates_new_host_if_hostname_doesnt_exists(
        RummagerRepositoryInterface $repository,
        HostEntity $hostEntity
    ) {
        $repository
            ->hostByName(Argument::type(HostName::class))
            ->willThrow(NotExistingHostException::class);

        $repository
            ->addHost(Argument::type(HostValues::class))
            ->willReturn($hostEntity);

        $this->hostIdByName('example.com')->shouldReturn(self::HOST_ID);
    }

    public function it_counts_nodes_running(
        RummagerRepositoryInterface $repository,
        HostEntity $hostEntity
    ) {
        foreach($this->nodesRunningData() as $testData) {
            $this->test_counts_nodes_running($repository, $hostEntity, ...$testData);
        }
    }

    public function it_returns_max_nodes_allowed(
        RummagerRepositoryInterface $repository,
        HostEntity $hostEntity
    ) {
        $hostEntity->getN()->willReturn(10);
        $repository->host(Argument::type(HostIdentity::class))->willReturn($hostEntity);
        $this->getMaxNodes(self::HOST_ID)->shouldReturn(10);
    }

    public function it_returns_max_threads_allowed(
        RummagerRepositoryInterface $repository,
        HostEntity $hostEntity
    ) {
        $hostEntity->getT()->willReturn(10);
        $repository->host(Argument::type(HostIdentity::class))->willReturn($hostEntity);
        $this->getMaxThreads(self::HOST_ID)->shouldReturn(10);
    }

    public function it_checks_if_node_is_running(RummagerRepositoryInterface $repository)
    {
        $repository->node(Argument::type(NodeIdentity::class))->willReturn(new NodeEntity());
        $this->checkNodeIsRunning(self::NODE_ID)->shouldReturn(false);
    }

    public function it_checks_if_node_is_running_true(RummagerRepositoryInterface $repository)
    {
        $repository
            ->node(Argument::type(NodeIdentity::class))
            ->willReturn($this->createRunningNode());

        $this->checkNodeIsRunning(self::NODE_ID)->shouldReturn(true);
    }

    public function it_should_create_node(
        RummagerRepositoryInterface $repository,
        HostEntity $hostEntity,
        NodeEntity $nodeEntity
    )
    {
        $nodeEntity->getId()->willReturn(self::NODE_ID);
        $repository->host(Argument::type(HostIdentity::class))->willReturn($hostEntity);
        $repository->addNode(Argument::type(NodeValues::class))->willReturn($nodeEntity);
        $this->getNewNodeId(self::HOST_ID)->shouldReturn(self::NODE_ID);
    }

    private function test_counts_nodes_running(
        RummagerRepositoryInterface $repository,
        HostEntity $hostEntity,
        Collection $nodesCollection,
        int $expectedValue
    ) {
        $hostEntity->getNodes()->willReturn($nodesCollection);

        $repository
            ->host(Argument::type(HostIdentity::class))
            ->willReturn($hostEntity);

        $this->nodesRunning(self::HOST_ID)->shouldReturn($expectedValue);
    }

    private function nodesRunningData()
    {
        yield [new Collection(), 0];

        yield[
            new Collection([new NodeEntity()]), 
            0,
        ];

        yield[
            new Collection([$this->createRunningNode()]), 
            1,
        ];

        yield[
            new Collection([
                new NodeEntity(),
                $this->createRunningNode(),
                new NodeEntity(),
                $this->createRunningNode(),
                $this->createRunningNode(),
            ]),
            3,
        ];
    }

    private function createRunningNode(): NodeEntity
    {
        $nodeStatus = new class extends NodeStatus {
            public function getId(): int
            {
                return \Rummager\Service\Host\Node\Status::RUNNING;
            }
        };

        $node = new NodeEntity();
        $node->setStatus($nodeStatus);

        return $node;
    }
}
