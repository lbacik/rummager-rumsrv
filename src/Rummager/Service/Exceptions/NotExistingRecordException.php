<?php

declare(strict_types=1);

namespace Rummager\Service\Exceptions;

use RuntimeException;

class NotExistingRecordException extends RuntimeException
{
    public static function id(int $id, string $entityClass): self
    {
        return new self(sprintf('Can not find %s for id: %d', $entityClass, $id));
    }
}
