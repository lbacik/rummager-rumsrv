<?php

declare(strict_types=1);

namespace Rummager\Behat\Traits;

use Behat\Gherkin\Node\TableNode;
use Doctrine\ORM\Mapping\ClassMetadata;

trait EntityTrait
{
    /**
     * @param mixed $entity
     * @return mixed
     */
    private function setEntityId($entity, int $id)
    {
        $reflection = new \ReflectionObject($entity);
        $propertyId = $reflection->getProperty('id');
        $propertyId->setAccessible(true);
        $propertyId->setValue($entity, $id);

        return $entity;
    }

    private function prepareTable(string $entityClass): void
    {
        $metadata = $this->em->getClassMetadata($entityClass);

        $schemaTool = new \Doctrine\ORM\Tools\SchemaTool($this->em);
        $schemaTool->dropSchema([$metadata]);
        $schemaTool->createSchema([$metadata]);

        $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    }

    protected function createTable(TableNode $table, string $entityClass): void
    {
        $this->prepareTable($entityClass);

        foreach ($table as $row) {
            $module = $this->newEntity($row);
            $this->em->persist($module);
        }
        $this->em->flush();
    }

}
