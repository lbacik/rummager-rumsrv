<?php

declare(strict_types=1);

namespace spec\Rummager\Service;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Rummager\Service\CheckProcessRepositoryInterface;
use Rummager\Service\Host;
use Rummager\Service\Module;
use Rummager\Service\Module\Module as ModuleEntity;
use Rummager\Service\Check as CheckEntity;
use Rummager\Service\CheckProcess\CheckValues;
use Rummager\Service\CheckProcess\CheckIdentity;
use Rummager\Service\CheckProcess;
use Rummager\Service\Network\Ipv4Class;
use Rummager\Service\Node;

class CheckProcessSpec extends ObjectBehavior
{
    public function let(
        CheckProcessRepositoryInterface $repository,
        Host $host,
        Module $module
    ) {
        $this->beConstructedWith(
            $repository,
            $host,
            $module
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(CheckProcess::class);
    }

    public function it_starts_new_check_process(
        CheckProcessRepositoryInterface $repository,
        Host $host,
        Node $worker,
        Module $module,
        Module\Module $smtp,
        CheckEntity $checkEntity
    ) {
        $checkEntity->getId()->willReturn(10);
        $repository->add(Argument::type(CheckValues::class))->willReturn($checkEntity);
        $host->worker(1)->willReturn($worker);
        $module->get(1)->willReturn($smtp);
        $this->startNew(1, 1)->shouldReturn(10);
    }

    public function it_returns_network_id(
        CheckProcessRepositoryInterface $repository,
        Ipv4Class $ipClass,
        CheckEntity $check
    ) {
        $ipClass->getId()->willReturn(10);
        $check->getNet()->willReturn($ipClass);
        $repository->get(Argument::type(CheckIdentity::class))->willReturn($check);
        $this->getNetworkId(1)->shouldReturn(10);
    }

    public function it_returns_module_id(
        CheckProcessRepositoryInterface $repository,
        CheckEntity $check,
        ModuleEntity $moduleEntity
    ) {
        $checkId = 10;
        $moduleId = 1;

        $moduleEntity->getId()->willReturn($moduleId);
        $check->getModule()->willReturn($moduleEntity);
        $repository->get(Argument::type(CheckIdentity::class))->willReturn($check);
        $this->getModuleId($checkId)->shouldReturn($moduleId);
    }
}
