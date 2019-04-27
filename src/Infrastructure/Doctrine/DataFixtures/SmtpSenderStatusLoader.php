<?php

namespace Rummager\Infrastructure\Doctrine\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Rummager\Module\SmtpSenderStatus;

class SmtpSenderStatusLoader extends FixtureAbstract implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $this->addEntity([
            'id' => 1,
            'name' => 'done'
        ]);

        $this->addEntity([
            'id' => 2,
            'name' => 'in progress'
        ]);
    }

    protected function createEntity(array $data)
    {
       $entity = new SmtpSenderStatus();

       $entity->setId($data['id']);
       $entity->setName($data['name']);

       return $entity;
    }
}
