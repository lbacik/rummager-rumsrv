<?php

declare(strict_types=1);

namespace spec\Rummager\Service;

use Rummager\Service\Network\Ipv4Class;
use Rummager\Service\Network\Ipv4ClassStatus;
use Rummager\Service\Network;
use Rummager\Service\Network\Status;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Rummager\Service\Ipv4ClassRepositoryInterface;

class NetworkSpec extends ObjectBehavior
{
    const NETWORK_ID = 1;
    const NETWORK = '1.1.1.0';
    const IP = '1.1.1.1';
    const MASK_CIDR = '24';
    const MASK = '255.255.255.0';
    const BROADCAST = '1.1.1.255';

    public function let(
        Ipv4ClassRepositoryInterface $repository,
        Ipv4Class $network
    ) {
        $this->beConstructedWith($repository);

        $network->getIp()->willReturn(self::IP);
        $network->getMask()->willReturn(self::MASK_CIDR);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Network::class);
    }

    public function it_returns_network_to_check(
        Ipv4ClassRepositoryInterface $repository,
        Ipv4Class $network
    ) {
        $repository->networkToCheck()->willReturn($network);
        $this->getNetworkToCheck()->shouldReturn($network);
    }

    public function it_returns_network_as_string(
        Ipv4ClassRepositoryInterface $repository,
        Ipv4Class $network
    ) {
        $repository->network(Argument::any())->willReturn($network);
        $this
            ->getNetworkAsCidr(self::NETWORK_ID)
            ->shouldReturn(self::IP . '/' . self::MASK_CIDR);
    }

    public function it_updates_status(
        Ipv4ClassRepositoryInterface $repository,
        Ipv4Class $network,
        Ipv4ClassStatus $status
    ) {
        $network->setStatus($status)->shouldBeCalled();
        $repository->networkForIpAndMask(
            Argument::any(),
            Argument::any()
        )->willReturn($network);
        $repository->networkStatus(Argument::any())->willReturn($status);
        $this->updateStatus(self::IP, self::MASK_CIDR, Status::STATUS_FINISHED);
    }
}
