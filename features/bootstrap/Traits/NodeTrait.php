<?php

declare(strict_types=1);

namespace Rummager\Behat\Traits;

use Behat\Gherkin\Node\TableNode;
use Rummager\Service\Host\HostIdentity;
use Rummager\Service\Host\Node\NodeEntityFactory;
use Rummager\Service\Host\Node\NodeValues;
use Rummager\Service\Node;

trait NodeTrait
{
    public function createNodeTable(TableNode $table)
    {
        $this->prepareTable(Node::class);

        foreach ($table as $row) {
            $node = $this->getNewNodeEntity($row);
            $this->em->persist($node);
        }
        $this->em->flush();
    }

    private function getNewNodeEntity(array $row): Node
    {
        $hostIdentity = HostIdentity::create(intval($row['hid']));
        $host = $this->repository->host($hostIdentity);
        $nodeValues = NodeValues::create($host);
        $node = NodeEntityFactory::create($nodeValues);
        return $this->setEntityId($node, intval($row['id']));
    }
}
