<?php

declare(strict_types=1);

namespace spec\Rummager\Service;

use Rummager\Service\Module;
use PhpSpec\ObjectBehavior;
use Rummager\Service\Module\Smtp\Smtp as SmtpModule;
use Rummager\Service\Module\Factory as ModuleFactory;
use Rummager\Service\ModuleRepositoryInterface;

class ModuleSpec extends ObjectBehavior
{
    public function let(
        ModuleFactory $factory,
        ModuleRepositoryInterface $repository
    ) {
        $this->beConstructedWith(
            $factory,
            $repository
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Module::class);
    }

    public function it_returns_module(ModuleFactory $factory, SmtpModule $smtp)
    {
        $smtp->id()->willReturn(1);
        $factory->moduleByName('smtp')->willReturn($smtp);
        $this->moduleIdByName('smtp')->shouldReturn(1);
    }

    public function it_adds_data(ModuleFactory $factory, SmtpModule $smtp)
    {
        $moduleId = 1;
        $data = [];

        $factory->moduleById($moduleId)->willReturn($smtp);
        $this->addData($moduleId, $data);
    }
}
