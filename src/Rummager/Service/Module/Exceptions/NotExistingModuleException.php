<?php

declare(strict_types=1);

namespace Rummager\Service\Module\Exceptions;

class NotExistingModuleException extends \RuntimeException
{
    public static function id(int $id): self
    {
        return new self('Not existing module, id: ' . $id);
    }

    public static function name(string $name): self
    {
        return new self(sprintf('Not existing module, name: %s', $name));
    }
}
