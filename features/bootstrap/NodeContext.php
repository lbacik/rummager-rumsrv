<?php

declare(strict_types=1);

namespace Rummager\Behat;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Rummager\Behat\Base\BaseRepositoryFeature;
use Rummager\Behat\Traits\EntityTrait;
use Rummager\Behat\Traits\NodeTrait;

class NodeContext extends BaseRepositoryFeature implements Context
{
    use EntityTrait;
    use NodeTrait;

    /**
     * @Given the following nodes exist:
     */
    public function addNodes(TableNode $table)
    {
        $this->createNodeTable($table);
    }
}
