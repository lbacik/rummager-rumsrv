<?php

declare(strict_types=1);

namespace Rummager\Service\Host\Node\Exceptions;

class NotExistingNodeException extends \RuntimeException
{
    public static function id(int $id): NotExistingNodeException
    {
        return new static('Not existing node, id: ' . $id);
    }
}
