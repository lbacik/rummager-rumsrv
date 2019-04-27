<?php

declare(strict_types=1);

namespace Rummager\Service\Network;

use Rummager\Infrastructure\OneValueValueObject;

class Ip extends OneValueValueObject
{
    protected $keys = [
        self::KEY_VALUE => 'required|string|min:7|max:15'
    ];
}
