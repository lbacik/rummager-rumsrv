<?php

declare(strict_types=1);

namespace Rummager\Service\Network\Exceptions;

use RuntimeException;

class NotExistingNetworkStatusException extends RuntimeException
{
    public static function create(): self
    {
        return new self();
    }
}
