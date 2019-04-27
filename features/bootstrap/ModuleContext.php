<?php

declare(strict_types=1);

namespace Rummager\Behat;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert;
use Rummager\Behat\Base\BaseRepositoryFeature;
use Rummager\Behat\Traits\EntityTrait;
use Rummager\Behat\Traits\ModuleTrait;
use Rummager\Service\Module\ModuleName;

class ModuleContext extends BaseRepositoryFeature implements Context
{
    use EntityTrait;
    use ModuleTrait;

    /**
     * @Given the following modules exist:
     */
    public function addModules(TableNode $table)
    {
        $this->createModuleTable($table);
    }

    /**
     * @When client tries to get module passing name :name
     */
    public function clientTriesToGetModulePassingName(string $name)
    {
        try {
            $moduleName = ModuleName::create($name);
            $this->result = $this->repository->moduleByName($moduleName);
        } catch (\Exception $e) {
            $this->result = $e;
        }
    }

    /**
     * @Then module's result_tab value should be :value
     */
    public function moduleResultsTabShouldBeSmtp(string $value)
    {
        Assert::assertEquals($value, $this->result->getResultTab());
    }

    /**
     * @Then repository should return :entity entity with id :id 2
     */
    public function repositoryShouldReturnEntityWithId(string $entity, int $id)
    {
        Assert::assertInstanceOf($entity, $this->result);
        Assert::assertEquals($id, $this->result->getId());
    }

    /**
     * @Then repository should throw exception: :exception 2
     */
    public function repositoryShouldThrowException(string $exception)
    {
        Assert::assertInstanceOf(
            $exception,
            $this->result
        );
    }
}
