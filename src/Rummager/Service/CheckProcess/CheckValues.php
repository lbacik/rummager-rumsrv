<?php

declare(strict_types=1);

namespace Rummager\Service\CheckProcess;

use Rummager\Infrastructure\EmptyValueObject;
use Rummager\Service\Module\Module;
use Rummager\Service\Network\Ipv4Class;
use Rummager\Service\Node;

class CheckValues extends EmptyValueObject
{
    const KEY_NODE = 'node';
    const KEY_MODULE = 'module';
    const KEY_NET = 'net';

    protected array $keys = [
        self::KEY_NODE => 'instance_of:' . Node::class,
        self::KEY_MODULE => 'instance_of:' . Module::class,
        self::KEY_NET => 'nullable|instance_of:' . Ipv4Class::class,
    ];

    public static function create(
        Node $node,
        Module $module,
        ?Ipv4Class $net = null
    ): CheckValues {
        return new self([
            self::KEY_NODE => $node,
            self::KEY_MODULE => $module,
            self::KEY_NET => $net,
        ]);
    }
}
