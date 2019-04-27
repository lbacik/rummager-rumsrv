<?php

declare(strict_types=1);

namespace Rummager\Behat\Traits;

use Rummager\Service\Host\Host;
use Behat\Gherkin\Node\TableNode;
use Rummager\Service\Host\HostEntityFactory;
use Rummager\Service\Host\HostName;
use Rummager\Service\Host\HostValues;

trait HostTrait
{
    protected function createHostTable(TableNode $table): void
    {
        $this->prepareTable(Host::class);

        foreach ($table as $row) {
            $host = $this->getNewHostEntity($row);
            $this->em->persist($host);
        }
        $this->em->flush();
    }

    private function getNewHostEntity(array $row): Host
    {
        $hostName = HostName::create($row['name']);
        $hostValues = HostValues::create($hostName);
        $host = HostEntityFactory::create($hostValues);
        return $this->setEntityId($host, intval($row['id']));
    }
}
