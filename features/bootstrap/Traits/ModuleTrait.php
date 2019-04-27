<?php

declare(strict_types=1);

namespace Rummager\Behat\Traits;

use Behat\Gherkin\Node\TableNode;
use Rummager\Service\Module\Module;
use Rummager\Service\Module\ModuleName;
use Rummager\Service\Module\ModuleValues;

trait ModuleTrait
{
    protected function createModuleTable(TableNode $table): void
    {
        $this->prepareTable(Module::class);

        foreach ($table as $row) {
            $module = $this->newModuleEntity($row);
            $this->em->persist($module);
        }
        $this->em->flush();
    }

    private function newModuleEntity(array $row): Module
    {
        $moduleName = ModuleName::create($row['name']);
        $moduleValues = ModuleValues::create(
            $moduleName,
            $row['result_tab']
        );

        $module = new Module();
        $module->setName($moduleValues['name']());
        $module->setResultTab($moduleValues['result_tab']);

        return $this->setEntityId($module, intval($row['id']));
    }
}
