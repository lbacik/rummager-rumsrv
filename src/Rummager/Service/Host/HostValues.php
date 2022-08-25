<?php

declare(strict_types=1);

namespace Rummager\Service\Host;

use Rummager\Infrastructure\EmptyValueObject;

class HostValues extends EmptyValueObject
{
    const KEY_NAME = 'name';
    const KEY_NODES_QUANTITY = 'n';
    const KEY_THREADS_QUANTITY = 't';
    const KEY_SENDERS_QUANTITY = 's';

    protected array $keys = [
        self::KEY_NAME => 'instance_of:' . HostName::class,
        self::KEY_NODES_QUANTITY => 'nullable|integer',
        self::KEY_THREADS_QUANTITY => 'nullable|integer',
        self::KEY_SENDERS_QUANTITY => 'nullable|integer',
    ];

    public static function create(HostName $hostname): HostValues
    {
        return new self([
            self::KEY_NAME => $hostname,
        ]);
    }
}
