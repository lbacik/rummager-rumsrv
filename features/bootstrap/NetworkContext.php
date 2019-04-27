<?php

declare(strict_types=1);

namespace Rummager\Behat;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert;
use Rummager\Behat\Base\BaseRepositoryFeature;
use Rummager\Behat\Traits\EntityTrait;
use Rummager\Behat\Traits\NetworkTrait;
use Rummager\Service\Network\Ip;
use Rummager\Service\Network\Ipv4Class;
use Rummager\Service\Network\MaskCidr;
use Rummager\Service\Network\NetworkIdentity;
use Rummager\Service\Network\Status\NetworkStatusIdentity;

class NetworkContext extends BaseRepositoryFeature implements Context
{
    use EntityTrait;
    use NetworkTrait;

    /**
     * @Given the following Networks exist:
     */
    public function addNetworks(TableNode $table)
    {
        $this->createTable($table, Ipv4Class::class);
    }

    /**
     * @When client asks for a network to check
     */
    public function clientAsksForANetworkToCheck()
    {
        try {
            $this->setResult($this->repository->networkToCheck());
        } catch (\Exception $e) {
            $this->setResult($e);
        }
    }

    /**
     * @Then network id :id should be returned
     */
    public function networkIdShouldBeReturned(int $id)
    {
        $networkId = $this->getResult()->getId();
        Assert::assertSame($id, $networkId);
    }

    /**
     * @When client asks for network with id: :id
     */
    public function clientAsksForStatusOfTheNetworkWithId(int $id)
    {
        try {
            $networkId = NetworkIdentity::create($id);
            $this->setResult($this->repository->network($networkId));
        } catch (\Exception $e) {
            $this->setResult($e);
        }
    }

    /**
     * @Then network id: :id should be returned
     */
    public function networkIdShouldBeReturned2(int $expectedId)
    {
        $id = $this->getResult()->getId();
        Assert::assertSame($expectedId, $id);
    }

    /**
     * @Then ip should be :ip
     */
    public function ipShouldBe(string $expectedIp)
    {
        $ip = $this->getResult()->getIp();
        Assert::assertSame($expectedIp, $ip);
    }

    /**
     * @Then mask should be :mask
     */
    public function maskShouldBe(string $expectedMask)
    {
        $mask = $this->getResult()->getMask();
        Assert::assertSame($expectedMask, $mask);
    }

    /**
     * @Then status id should be :id
     */
    public function statusIdShouldBe(int $expectedStatusId)
    {
        $statusId = $this->getResult()->getStatus()->getId();
        Assert::assertSame($expectedStatusId, $statusId);
    }

    /**
     * @When client changes status of the network with id :nId to status id :sId
     */
    public function clientChangesStatusOfTheNetworkWithIdToStatusId(int $nId, int $sId)
    {
        $networkId = NetworkIdentity::create($nId);
        $network = $this->repository->network($networkId);

        $statusId = NetworkStatusIdentity::create($sId);
        $status = $this->repository->networkStatus($statusId);

        $this->repository->updateNetworkStatus($network, $status);
    }

    /**
     * @When client asks for network with ip :ip and mask :mask
     */
    public function workerAsksForNetworkWithIpAndMask(string $ip, int $mask)
    {
        try {
            $ipValue = Ip::create($ip);
            $maskValue = MaskCidr::create($mask);
            $this->setResult($this->repository->networkForIpAndMask($ipValue, $maskValue));
        } catch (\Exception $e) {
            $this->setResult($e);
        }
    }
}
