<?php

declare(strict_types=1);

namespace Rummager\Behat;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Rummager\Behat\Base\BaseRepositoryFeature;
use Rummager\Behat\Traits\EntityTrait;
use Rummager\Behat\Traits\HostTrait;

class HostContext extends BaseRepositoryFeature implements Context
{
    use EntityTrait;
    use HostTrait;

    /**
     * @Given the following hosts exist:
     */
    public function addHosts(TableNode $table)
    {
        $this->createHostTable($table);
    }
}
