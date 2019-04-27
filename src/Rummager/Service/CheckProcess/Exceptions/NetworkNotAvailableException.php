<?php

declare(strict_types=1);

namespace Rummager\Service\CheckProcess\Exceptions;

class NetworkNotAvailableException extends \RuntimeException
{
    public static function create(int $checkId): NetworkNotAvailableException
    {
        return new self('CheckId: ' . $checkId);
    }
}
