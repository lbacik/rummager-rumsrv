<?php

declare(strict_types=1);

namespace Rummager\Service\Module;

use Rummager\Infrastructure\OneValueValueObject;

class ModuleName extends OneValueValueObject
{
    protected $keys = [
        self::KEY_VALUE => 'required|string|min:1|max:45',
    ];
}
