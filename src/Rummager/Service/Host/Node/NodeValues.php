<?php

declare(strict_types=1);

namespace Rummager\Service\Host\Node;

use Rummager\Infrastructure\EmptyValueObject;
use Rummager\Service\Host\Host;

class NodeValues extends EmptyValueObject
{
    const KEY_CHECK = 'check';
    const KEY_HOST = 'host';

    protected $keys = [
        self::KEY_CHECK => 'integer',
        self::KEY_HOST => 'instance_of:' . Host::class,
    ];

    public static function create(Host $host): NodeValues
    {
        return new self([
            self::KEY_CHECK => 0,
            self::KEY_HOST => $host,
        ]);
    }
}
