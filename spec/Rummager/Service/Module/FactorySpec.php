<?php

declare(strict_types=1);

namespace spec\Rummager\Service\Module;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Rummager\Service\Module\Module as ModuleEntity;
use Rummager\Service\Module\Factory as ModuleFactory;
use Rummager\Service\Module\Smtp\Smtp;
use Rummager\Service\ModuleRepositoryInterface;
use Rummager\Service\ServiceProviderInterface;

class FactorySpec extends ObjectBehavior
{
    const MODULE_SMTP_ID = 1;
    const MODULE_SMTP_NAME = 'smtp';

    public function let(
        ModuleRepositoryInterface $repository,
        ServiceProviderInterface $serviceProvider,
        Smtp $smtp
    ) {
        $this->beConstructedWith($repository, $serviceProvider);

        $serviceProvider->offsetGet(self::MODULE_SMTP_NAME)->willReturn($smtp);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(ModuleFactory::class);
    }

    public function it_should_create_module_by_id_smtp(
        ModuleRepositoryInterface $repository,
        ModuleEntity $moduleEntity
    ) {
        $moduleEntity->getName()->willReturn(self::MODULE_SMTP_NAME);
        $repository->module(Argument::any())->willReturn($moduleEntity);
        $this->moduleById(self::MODULE_SMTP_ID)->shouldReturnAnInstanceOf(Smtp::class);
    }

    public function it_should_get_module_by_name() 
    {
        $this->moduleByName(self::MODULE_SMTP_NAME)->shouldReturnAnInstanceOf(Smtp::class);
    }
}
