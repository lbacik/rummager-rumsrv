<?php

declare(strict_types=1);

namespace Rummager\Infrastructure\Doctrine\Repositories;

use Doctrine\ORM\EntityManagerInterface;

abstract class GeneralRepository
{
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}
