<?php

declare(strict_types=1);

namespace Rummager\Service;

use Rummager\Infrastructure\OneValueValueObject;

class Identity extends OneValueValueObject
{
    protected $keys = [
        self::KEY_VALUE => 'required|integer|min:1'
    ];
}
