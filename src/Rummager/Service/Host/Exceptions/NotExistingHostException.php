<?php

declare(strict_types=1);

namespace Rummager\Service\Host\Exceptions;

class NotExistingHostException extends \RuntimeException
{
    public static function name(string $name): NotExistingHostException
    {
        return new self('Not existing host: ' . $name);
    }

    public static function id(int $id): NotExistingHostException
    {
        return new self('Not existing host, id: ' . $id);
    }
}
