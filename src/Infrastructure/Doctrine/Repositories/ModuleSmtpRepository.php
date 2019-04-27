<?php

declare(strict_types=1);

namespace Rummager\Infrastructure\Doctrine\Repositories;

use Doctrine\ORM\Query;
use Rummager\Module\Smtp;
use Rummager\Service\Module\Smtp\Exceptions\NoDataException;
use Rummager\Service\Module\Smtp\ModuleSmtpRecordFactory;
use Rummager\Service\Module\Smtp\SmtpValues;
use Rummager\Service\Network\Ip;

class ModuleSmtpRepository extends GeneralRepository // implements ModuleSmtpRepositoryInterface
{

    public function add(SmtpValues $values): Smtp
    {
        $entity = ModuleSmtpRecordFactory::create($values);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

    public function lastIp(Ip $networkIp, Ip $broadcast): string
    {
        $qb = $this
            ->entityManager
            ->createQueryBuilder();

        $query = $qb
            ->select('max(s.ip)')
            ->from(Smtp::class, 's')
            ->where('s.ip >= ?0')
            ->andWhere('s.ip <= ?1')
            ->getQuery();

        $result = $query->execute(
            [
                ip2long($networkIp()),
                ip2long($broadcast()),
            ],
            Query::HYDRATE_SINGLE_SCALAR
        );

        if ($result === null) {
            throw NoDataException::lastIp($networkIp(), $broadcast());
        }

        return long2ip(intval($result));
    }
}
