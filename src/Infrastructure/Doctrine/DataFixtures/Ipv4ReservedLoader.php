<?php

namespace Rummager\Infrastructure\Doctrine\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Rummager\Service\Network\Ipv4Reserved;

class Ipv4ReservedLoader extends FixtureAbstract implements FixtureInterface
{
    const NETWORK_LIST = __DIR__ . '/Resources/ip-classes-list.txt';

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        foreach ($this->readNetwork() as $network) {
            $this->addEntity($network);
        }
    }

    protected function createEntity(array $data)
    {
        $entity = new Ipv4Reserved();

        $entity->setIp($data['ip']);
        $entity->setMask($data['mask']);

        return $entity;
    }

    private function readNetwork()
    {
        $handle = fopen(self::NETWORK_LIST, "r");

        while($line = fgets($handle)) {
            yield $this->formatResult(trim($line));
        }

        fclose($handle);
    }

    private function formatResult(string $line): array
    {
        $tmp = mb_split('/', $line, 2);

        $network['ip'] = $tmp[0];
        $network['mask'] = $tmp[1];

        return $network;
    }
}
