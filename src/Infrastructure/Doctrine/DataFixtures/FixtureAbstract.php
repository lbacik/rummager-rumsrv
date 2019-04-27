<?php

namespace Rummager\Infrastructure\Doctrine\DataFixtures;

use Doctrine\Common\Persistence\ObjectManager;

abstract class FixtureAbstract
{
    /** @var ObjectManager */
    protected $manager;

    protected function addEntity(array $data)
    {
        $entity = $this->createEntity($data);

        $this->manager->persist($entity);
        $this->manager->flush();
    }

    /**
     * @return mixed
     */
    abstract protected function createEntity(array $data);
}
