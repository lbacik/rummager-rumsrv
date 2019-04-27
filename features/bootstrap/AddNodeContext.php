<?php

declare(strict_types=1);

namespace Rummager\Behat;

use Behat\Behat\Context\Context;
use Rummager\Behat\Base\BaseRepositoryFeature;
use Rummager\Service\Host\HostIdentity;
use Rummager\Service\Node;
use Rummager\Service\Host\Node\NodeValues;
use PHPUnit\Framework\Assert;

class AddNodeContext extends BaseRepositoryFeature implements Context
{
    /**
     * @todo Add this function to the Repository
     */
    private function addNodeForHostId(int $hostId): Node
    {
        $hostIdentity = HostIdentity::create($hostId);
        $host = $this->repository->host($hostIdentity);
        $nodeValues = NodeValues::create($host);
        $node = $this->repository->addNode($nodeValues);

        return $node;
    }

    /**
     * @When worker tries to add node for host id: :id
     */
    public function addNodeForNotExistingHost(int $id)
    {
        try {
            $this->result = $this->addNodeForHostId($id);
        } catch (\RuntimeException $e) {
            $this->result = $e;
        }
    }
 
    /**
     * @Then Exception :exception should be thrown / AddNodeContext
     */
    public function exceptionShouldBeThrown(string $exception)
    {
        Assert::assertInstanceOf($exception, $this->result);
    }

    /**
     * @Then node create timestamp has been set properly
     */
    public function nodeCreateTimestampHasBeenSetProperly()
    {
        $value = $this->result->getSTime();
        Assert::assertNotEmpty($value);
    }

    /**
     * @Then node should be added successfully
     */
    public function nodeShouldBeAddedSuccessfully()
    {
        Assert::assertInstanceOf(Node::class, $this->result);
    }

    /**
     * @Then node hid is :hid
     */
    public function nodeHidIs(int $hid)
    {
        $value = $this->result->getHost()->getId();
        Assert::assertSame($hid, $value);
    }
}
