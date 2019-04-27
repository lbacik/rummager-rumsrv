<?php

declare(strict_types=1);

namespace spec\Rummager\Service\Module\Smtp;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Rummager\Service\Check;
use Rummager\Service\Module\Smtp\ModuleSmtpRepositoryInterface;
use Rummager\Service\Module\Smtp\SmtpValues;
use Rummager\Service\Module\Smtp\Smtp;

class SmtpSpec extends ObjectBehavior
{
    public function let(ModuleSmtpRepositoryInterface $repository)
    {
        $this->beConstructedWith($repository);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Smtp::class);
    }

    public function it_should_return_module_id()
    {
        $this->id()->shouldReturn(1);
    }

    public function it_should_allow_to_save_data(
        ModuleSmtpRepositoryInterface $repository
    ) {

        $check = new Check();
        $data = [
            'check' => $check,
            'ip' => 1,
            'port' => 25,
            'helo' => null,
            'helo-code' => null,
            'ehlo' => null,
            'ehlo-code' => null,
            'greetings-code' => null,
            'greetings-text' => null,
            'checktime' => null,
            'tstart' => null,
            'tcon' => null,
            'tend' => null,
        ];
        
        $repository->add(Argument::type(SmtpValues::class))->shouldBeCalled();
        $this->save(array_values($data));
    }
}
