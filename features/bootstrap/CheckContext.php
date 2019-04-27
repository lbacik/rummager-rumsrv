<?php

declare(strict_types=1);

namespace Rummager\Behat;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\Assert;
use Rummager\Behat\Base\BaseRepositoryFeature;
use Rummager\Behat\Base\ServiceFactory;
use Rummager\Behat\Traits\CheckTrait;
use Rummager\Behat\Traits\EntityTrait;
use Rummager\Infrastructure\Doctrine\Repositories\GeneralRepository;
use Rummager\Infrastructure\Doctrine\Repositories\CheckProcessRepository;
use Rummager\Service\Check;
use Rummager\Service\CheckProcess\CheckValues;
use Rummager\Service\Host\Node\NodeIdentity;
use Rummager\Service\Module\Module;
use Rummager\Service\Module\ModuleIdentity;
use Rummager\Service\Network\Ipv4Class;
use Rummager\Service\Network\NetworkIdentity;
use Rummager\Service\Node;

class CheckContext extends BaseRepositoryFeature implements Context
{
    use EntityTrait;
    use CheckTrait;

    private $data = [];

    /** @var GeneralRepository */
    private $moduleRepository;

    /** @var GeneralRepository */
    private $networkRepository;

    /** @var CheckProcessRepository */
    private $checkRepository;

    public function __construct(
        ServiceFactory $serviceFactory,
        string $rummagerRepository,
        string $moduleRepository,
        string $networkRepository,
        string $checkRepository
    ) {
        parent::__construct($serviceFactory, $rummagerRepository);

        $this->moduleRepository = $this->serviceFactory->repository($moduleRepository, $this->em);
        $this->networkRepository = $this->serviceFactory->repository($networkRepository, $this->em);
        $this->checkRepository = $this->serviceFactory->repository($checkRepository, $this->em);
    }

    /**
     * @Given the following checks exist:
     */
    public function addChecks(TableNode $table)
    {
        $this->createTable($table, Check::class);
    }

    /**
     * @Given new check process module id is :id
     */
    public function newCheckProcessModuleIdIs(string $id)
    {
        $this->setNullableValue(CheckValues::KEY_MODULE, $id);
    }

    /**
     * @Given new check process node id is :id
     */
    public function newCheckProcessNodeIdIs(string $id)
    {
        $this->setNullableValue(CheckValues::KEY_NODE, $id);
    }

    /**
     * @Given new check process network id is :id
     */
    public function newCheckProcessNetworkIdIs(string $id)
    {
        $this->setNullableValue(CheckValues::KEY_NET, $id);
    }

    /**
     * @When client tries to add new check process
     */
    public function clientTriesToAddNewCheckProcess()
    {
        try {
            $node = $this->getNode($this->data[CheckValues::KEY_NODE]);
            $module = $this->getModule($this->data[CheckValues::KEY_MODULE]);
            $net = $this->getNetwork($this->data[CheckValues::KEY_NET]);

            $values = CheckValues::create($node, $module, $net);
            $this->setResult($this->checkRepository->add($values));
        } catch (\TypeError | \Exception $e) {
            $this->setResult($e);
        }
    }

    /**
     * @Then new check process should be added successfully
     */
    public function newCheckProcessShouldBeAddedSuccessfully()
    {
        Assert::assertInstanceOf(Check::class, $this->getResult());
    }

    private function setNullableValue($key, $value): void
    {
        if ($value === 'null') {
            $this->data[$key] = null;
        } else {
            $this->data[$key] = intval($value);
        }
    }

    private function getNode(?int $id): ?Node
    {
        try {
            $nodeIdentity = NodeIdentity::create($id);
            $node = $this->repository->node($nodeIdentity);
        } catch (ValidationException $e) {
            $node = null;
        }

        return $node;
    }

    private function getModule(?int $id): ?Module
    {
        try {
            $moduleIdentity = ModuleIdentity::create($id);
            $module = $this->moduleRepository->module($moduleIdentity);
        } catch (ValidationException $e) {
            $module = null;
        }

        return $module;
    }

    private function getNetwork(?int $id): ?Ipv4Class
    {
        try {
            $networkIdentity = NetworkIdentity::create($id);
            $net = $this->networkRepository->network($networkIdentity);
        } catch (ValidationException $e) {
            $net = null;
        }

        return $net;
    }
}
