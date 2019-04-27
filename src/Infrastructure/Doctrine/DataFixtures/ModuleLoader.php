<?php

namespace Rummager\Infrastructure\Doctrine\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Rummager\Service\Module\Module;

class ModuleLoader extends FixtureAbstract implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $this->addEntity([
            'id' => 1,
            'name' => 'smtp',
            'result_tab' => 'smtp',
        ]);

        $this->addEntity([
            'id' => 2,
            'name' => 'smtp-sender',
            'result_tab' => 'smtp_sender',
        ]);
    }

    protected function createEntity(array $data)
    {
        $entity = new Module();

        $entity->setId($data['id']);
        $entity->setName($data['name']);
        $entity->setResultTab($data['result_tab']);

        return $entity;
    }
}