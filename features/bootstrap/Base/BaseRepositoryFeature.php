<?php

declare(strict_types=1);

namespace Rummager\Behat\Base;

use Doctrine\ORM\EntityManagerInterface;

abstract class BaseRepositoryFeature
{
    /** @var ServiceFactory */
    protected $serviceFactory;

    /** @var mixed */
    protected $result;

    /** @var mixed */
    protected $repository;

    /** @var EntityManagerInterface */
    protected $em;

    public function __construct(ServiceFactory $serviceFactory, $repositoryName)
    {
        $this->serviceFactory = $serviceFactory;

        $this->em = $this->serviceFactory->entityManager();
        $this->repository = $this->serviceFactory->repository($repositoryName, $this->em);
    }

    protected function setResult($value): void
    {
        Result::getInstance()->setValue($value);
    }

    protected function getResult()
    {
        return Result::getInstance()->getValue();
    }
}
