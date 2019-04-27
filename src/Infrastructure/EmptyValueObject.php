<?php

declare(strict_types=1);

namespace Rummager\Infrastructure;

use Rummager\Service\ValueObjectInterface;
use Sushi\Validator\IlluminateValidationValidator;
use Sushi\Validator\KeysValidator;
use Sushi\ValueObject;

class EmptyValueObject extends ValueObject implements ValueObjectInterface
{
    protected $validators = [
        KeysValidator::class,
        IlluminateValidationValidator::class,
    ];
}
