<?php

declare(strict_types=1);

namespace Rummager\Behat;

use Behat\Behat\Context\Context;
use PHPUnit\Framework\Assert;
use Rummager\Behat\Base\BaseRepositoryFeature;
use Rummager\Service\Host\HostName;
use Rummager\Service\Host\HostValues;

class AddHostContext extends BaseRepositoryFeature implements Context
{
    /**
     * @Given set host :property to :value
     */
    public function setHostProperty(string $property, string $value)
    {
        $this->addValue($property, $value);
    }

    /**
     * @When client tries to add host
     */
    public function clientTriesToAddHost()
    {
        try {
            $this->result = $this->repository->addHost($this->values);
        } catch (\Exception $e) {
            $this->result = $e;
        }
    }

    /**
     * @Then host should be added successfully
     */
    public function hostShouldBeAddedSucessfully()
    {
        $hostName = $this->values['name'];
        $host = $this->repository->hostByName($hostName);
        Assert::assertSame($hostName(), $host->getName());
    }

    /**
     * @Then host id: :id should be returned
     */
    public function hostIdShouldBeReturned(int $id)
    {
        $hostId = $this->result->getId();
        Assert::assertSame($id, $hostId);
    }

    /**
     * @Then Exception :exception should be thrown / AddHostContext
     */
    public function exceptionShouldBeThrown(string $exception)
    {
        Assert::assertInstanceOf($exception, $this->result);
    }

    /**
     * @Then host :valueName value is :expected
     */
    public function hostValueIs(string $valueName, string $expected)
    {
        $result = $this->getHostValue($valueName);
        Assert::assertEquals($expected, $result);
    }

    /**
     * @Then host create timestamp has been set properly
     */
    public function tableCreateTimestampHasBeenSetProperly()
    {
        $value = $this->result->getCreateTime();
        Assert::assertNotEmpty($value);
    }

    private function addValue(string $property, string $value): void
    {
        switch ($property) {
            case 'name':
                $this->values = HostValues::create(HostName::create($value));
                break;
            default:
                $this->values = $this->values->set([$property => intval($value)]);
                break;
        }
    }

    /**
     * @return mixed
     */
    private function getHostValue(string $valueName)
    {
        switch ($valueName) {
            case 'name':
                return $this->result->getName();
                break;
            case 'n':
                return $this->result->getN();
                break;
            case 't':
                return $this->result->getT();
                break;
            case 's':
                return $this->result->getS();
                break;
        }
    }
}
