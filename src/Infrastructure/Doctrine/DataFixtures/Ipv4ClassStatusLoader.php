<?php

namespace Rummager\Infrastructure\Doctrine\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Rummager\Service\Network;
use Rummager\Service\Network\Ipv4ClassStatus;

class Ipv4ClassStatusLoader extends FixtureAbstract implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $this->addEntity([
            'id' => Network\Status::STATUS_TODO,
            'name' => 'todo',
        ]);

        $this->addEntity([
            'id' => Network\Status::STATUS_FINISHED,
            'name' => 'finished',
        ]);

        $this->addEntity([
            'id' => Network\Status::STATUS_ONHOLD,
            'name' => 'on hold',
        ]);
    }

    protected function createEntity(array $data)
    {
       $entity = new Ipv4ClassStatus();

       $entity->setId($data['id']);
       $entity->setName($data['name']);

       return $entity;
    }
}
