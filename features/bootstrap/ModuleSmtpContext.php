<?php

declare(strict_types=1);

namespace Rummager\Behat;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert;
use Rummager\Behat\Base\BaseRepositoryFeature;
use Rummager\Behat\Base\ServiceFactory;
use Rummager\Behat\Traits\EntityTrait;
use Rummager\Behat\Traits\ModuleSmtpTrait;
use Rummager\Infrastructure\Doctrine\Repositories\CheckProcessRepository;
use Rummager\Module\Smtp;
use Rummager\Service\CheckProcess\CheckIdentity;
use Rummager\Service\Module\Smtp\SmtpValues;
use Rummager\Service\Network\Ip;

class ModuleSmtpContext extends BaseRepositoryFeature implements Context
{
    use EntityTrait;
    use ModuleSmtpTrait;

    private $data = [];

    /** @var SmtpValues|null */
    private $values;

    /** @var CheckProcessRepository */
    private $checkRepository;

    public function __construct(
        ServiceFactory $serviceFactory,
        string $repositoryName,
        string $checkRepository
    ) {
        parent::__construct($serviceFactory, $repositoryName);
        $this->checkRepository = $this->serviceFactory->repository($checkRepository, $this->em);
    }

    /**
     * @Given the following records in smtp table exist:
     */
    public function addModuleSmtpRecords(TableNode $table)
    {
        $this->createTable($table, Smtp::class);
    }

    /**
     * @When client asks for last ip for network with ip :ip and broadcast :bcast
     */
    public function clientAsksForLastIpForNetworkWithIpAndBroadcast(string $ip, string $bcast)
    {
        try {
            $networkIp = Ip::create($ip);
            $broadcast = Ip::create($bcast);
            $this->setResult($this->repository->lastIp($networkIp, $broadcast));
        } catch (\Exception $e) {
            $this->setResult($e);
        }
    }

    /**
     * @Then ip :ip should be returned
     */
    public function ipShouldBeReturned(string $ip)
    {
        $result = $this->getResult();
        Assert::assertSame($ip, $result);
    }

    /**
     * @Given Smtp Module Data check id is :checkId
     */
    public function smtpModuleDataCheckIdIs(int $checkId)
    {
        $this->data['checkId'] = $checkId;
    }

    /**
     * @Given Smtp Module Data ip is :ip
     */
    public function smtpModuleDataIpIs(string $ip)
    {
        $this->data['ip'] = $ip;
    }

    /**
     * @When client tries to add Smtp Module Data
     */
    public function clientTriesToAddSmtpModuleData()
    {
        try {
            $checkIdentity = CheckIdentity::create($this->data['checkId']);
            $check = $this->checkRepository->get($checkIdentity);
            $values = SmtpValues::create(
                $check,
                ip2long($this->data['ip']),
                25,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null
            );
            $this->setResult($this->repository->add($values));
        } catch (\Exception $e) {
            $this->setResult($e);
        }
    }

    /**
     * @Then Smtp Module Data shoule be added successfully
     */
    public function smtpModuleDataShouleBeAddedSuccessfully()
    {
        Assert::assertInstanceOf(Smtp::class, $this->getResult());
    }

    /**
     * @Then Smtp Module record create timestamp should be set properly
     */
    public function smtpModuleRecordCreateTimestampShouldBeSetProperly()
    {
        throw new PendingException();
    }
}
