<?php

declare(strict_types=1);

namespace Rummager\Service\Network\Status;

use Rummager\Service\Identity;

class NetworkStatusIdentity extends Identity
{
    protected $keys = [
        self::KEY_VALUE => 'required|integer|min:1',
    ];
}
