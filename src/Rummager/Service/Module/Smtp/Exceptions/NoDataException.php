<?php

declare(strict_types=1);

namespace Rummager\Service\Module\Smtp\Exceptions;

use RuntimeException;

class NoDataException extends RuntimeException
{
    public static function lastIp(string $network, string $broadcast): self
    {
        return new self(
            sprintf(
                'There is no records yet for network: %s/%s',
                $network,
                $broadcast
            )
        );
    }
}
