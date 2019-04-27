<?php

declare(strict_types=1);

namespace Rummager\Behat\Traits;

use Rummager\Module\Smtp;
use Rummager\Service\CheckProcess\CheckIdentity;
use Rummager\Service\Module\Smtp\ModuleSmtpRecordFactory;
use Rummager\Service\Module\Smtp\SmtpValues;

trait ModuleSmtpTrait
{
    private function newEntity(array $row): Smtp
    {

        $checkId = CheckIdentity::create(intval($row['check']));
        $check = $this->checkRepository->get($checkId);

        $values = SmtpValues::create(
            $check,
            ip2long($row['ip_decoded']),
            25,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null
        );

        $record = ModuleSmtpRecordFactory::create($values);

        return $this->setEntityId($record, intval($row['id']));
    }
}
