<?php

declare(strict_types=1);

namespace Rummager\Infrastructure\Doctrine\Repositories;

use Doctrine\ORM\EntityManagerInterface;
use Rummager\Service\Check as CheckEntity;
use Rummager\Service\CheckProcess\CheckIdentity;
use Rummager\Service\CheckProcess\CheckProcessEntityFactory;
use Rummager\Service\CheckProcess\CheckValues;
use Rummager\Service\CheckProcessRepositoryInterface;
use Rummager\Service\Exceptions\NotExistingRecordException;

class CheckProcessRepository extends GeneralRepository implements CheckProcessRepositoryInterface
{
    /** @var CheckProcessEntityFactory */
    private $entityFactory;

    public function __construct(
        EntityManagerInterface $entityManager,
        string $entityFactory
    ) {
        parent::__construct($entityManager);
        $this->entityFactory = $entityFactory;
    }

    public function add(CheckValues $checkValueObject): CheckEntity
    {
        $entity = $this->entityFactory::create($checkValueObject);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

    public function get(CheckIdentity $checkIdentity): CheckEntity
    {
        $result = $this
            ->entityManager
            ->getRepository(CheckEntity::class)
            ->findOneBy(['id' => $checkIdentity()]);

        if ($result === null) {
            throw NotExistingRecordException::id($checkIdentity(), CheckEntity::class);
        }

        return $result;
    }
}
