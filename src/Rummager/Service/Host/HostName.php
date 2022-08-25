<?php

declare(strict_types=1);

namespace Rummager\Service\Host;

use Rummager\Infrastructure\OneValueValueObject;

class HostName extends OneValueValueObject
{
    protected array $keys = [
        self::KEY_VALUE => 'required|string|min:1|max:45',
    ];
}
