<?php

declare(strict_types=1);

namespace Rummager\Service\Host\Node;

use Rummager\Service\Node;

class NodeEntityFactory
{
    const DEFAULT_CID_VALUE = 0;

    public static function create(NodeValues $values): Node
    {
        $node = new Node();

        $node->setCid($values[NodeValues::KEY_CHECK] ?? self::DEFAULT_CID_VALUE);
        $node->setSTime(new \DateTime());
        $node->setHost($values[NodeValues::KEY_HOST]);

        return $node;
    }
}
