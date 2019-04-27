<?php

declare(strict_types=1);

namespace Rummager\Behat;

use Behat\Behat\Context\Context;
use Rummager\Behat\Base\BaseRepositoryFeature;
use Rummager\Service\Host\HostIdentity;
use Rummager\Service\Host\HostName;
use Rummager\Service\Host\Node\NodeIdentity;
use PHPUnit\Framework\Assert;

class FeatureContext extends BaseRepositoryFeature implements Context
{
    /**
     * @Then repository should return :entity entity with :property :value
     */
    public function repositoryShouldReturnEntityWithProperty(
        string $entity,
        string $property,
        string $expected
    ) {
        Assert::assertInstanceOf($entity, $this->result);

        $value = $this->getResultPropertyValue($property);
        Assert::assertEquals($expected, $value);
    }

    /**
     * @Then repository should throw exception: :exception
     */
    public function repositoryShouldThrowException(string $exception)
    {
        Assert::assertInstanceOf(
            $exception,
            $this->result
        );
    }

    /**
     * @When client tries to get host's entity passing name :hostname
     */
    public function clientTriesToGetHostEntityProvidingNameRummagerNet(string $hostname)
    {
        try {
            $hostNameVO = HostName::create($hostname);
            $this->result = $this->repository->hostByName($hostNameVO);
        } catch (\Exception $e) {
            $this->result = $e;
        }
    }

    /**
     * @When client tries to get host's entity passing id :id
     */
    public function clientTriesToGetHostEntityProvidingId(int $id)
    {
        try {
            $hostId = HostIdentity::create($id);
            $this->result = $this->repository->host($hostId);
        } catch (\Exception $e) {
            $this->result = $e;
        }
    }

    /**
     * @When client tries to get node's entity passing id :id
     */
    public function clientTriesToGetNodeEntityProvidingId(int $id)
    {
        try {
            $nodeId = NodeIdentity::create($id);
            $this->result = $this->repository->node($nodeId);
        } catch (\Exception $e) {
            $this->result = $e;
        }
    }

    /**
     * @return mixed
     */
    private function getResultPropertyValue(string $propertyName)
    {
        switch($propertyName) {
            case 'id':
                $result = $this->result->getId();
                break;
            case 'name':
                $result = $this->result->getName();
                break;
            case 'host.id':
                $result = $this->result->getHost()->getId();
                break;
            default:
                $result = null;
        }
        return $result;
    }
}
