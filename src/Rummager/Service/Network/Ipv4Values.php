<?php

declare(strict_types=1);

namespace Rummager\Service\Network;

use Rummager\Infrastructure\EmptyValueObject;

class Ipv4Values extends EmptyValueObject
{
    const KEY_IP = 'ip';
    const KEY_MASK = 'mask';
    const KEY_DESCRIPTION = 'description';
    const KEY_STATUS = 'status';

    protected array $keys = [
        self::KEY_IP => 'string|min:7|max:15',
        self::KEY_MASK => 'string|min:1|max:2',
        self::KEY_DESCRIPTION => 'string|max:45',
        self::KEY_STATUS => 'instance_of:' . Ipv4ClassStatus::class,
    ];

    public static function create(
        string $ip,
        string $mask,
        string $description,
        Ipv4ClassStatus $status
    ): self {
        return new self([
            self::KEY_IP => $ip,
            self::KEY_MASK => $mask,
            self::KEY_DESCRIPTION => $description,
            self::KEY_STATUS => $status
        ]);
    }
}
