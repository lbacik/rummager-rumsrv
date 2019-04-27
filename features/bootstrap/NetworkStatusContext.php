<?php

declare(strict_types=1);

namespace Rummager\Behat;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Rummager\Behat\Base\BaseRepositoryFeature;
use Rummager\Behat\Traits\EntityTrait;
use Rummager\Behat\Traits\NetworkStatusTrait;
use Rummager\Service\Network\Ipv4ClassStatus;

class NetworkStatusContext extends BaseRepositoryFeature implements Context
{
    use EntityTrait;
    use NetworkStatusTrait;

    /**
     * @Given the following Networks Statuses exist:
     */
    public function addNetworks(TableNode $table)
    {
        $this->createTable($table, Ipv4ClassStatus::class);
    }
}