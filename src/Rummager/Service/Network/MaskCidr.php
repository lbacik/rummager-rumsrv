<?php

declare(strict_types=1);

namespace Rummager\Service\Network;

use Rummager\Infrastructure\OneValueValueObject;

class MaskCidr extends OneValueValueObject
{
    protected array $keys = [
        self::KEY_VALUE => 'required|integer|min:0|max:32'
    ];
}
