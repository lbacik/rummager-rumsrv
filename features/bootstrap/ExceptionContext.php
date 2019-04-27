<?php

declare(strict_types=1);

namespace Rummager\Behat;

use Behat\Behat\Context\Context;
use PHPUnit\Framework\Assert;
use Rummager\Behat\Base\Result;

class ExceptionContext implements Context
{
    /**
     * @Then exception :expectedException should be thrown
     */
    public function exceptionShouldBeThrown(string $expectedException)
    {
        $exception = Result::getInstance()->getValue();
        Assert::assertInstanceOf(
            $expectedException,
            $exception
        );
    }
}
