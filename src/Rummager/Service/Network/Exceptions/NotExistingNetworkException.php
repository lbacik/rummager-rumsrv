<?php

declare(strict_types=1);

namespace Rummager\Service\Network\Exceptions;

class NotExistingNetworkException extends \RuntimeException
{
    public static function id(int $id): self
    {
        return new self(sprintf('The network with id: %d does not exist', $id));
    }

    public static function address(string $ip, int $mask): self
    {
        return new self(sprintf('The network %s/%d does not exist', $ip, $mask));
    }
}
