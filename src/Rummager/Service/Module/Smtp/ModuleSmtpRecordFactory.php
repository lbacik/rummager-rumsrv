<?php

declare(strict_types=1);

namespace Rummager\Service\Module\Smtp;

use Rummager\Module\Smtp;

class ModuleSmtpRecordFactory
{
    public static function create(SmtpValues $values): Smtp
    {
        $entity = new Smtp();

        $entity->setCheck($values[SmtpValues::KEY_CHECK]);
        $entity->setIp($values[SmtpValues::KEY_IP]);
        $entity->setPort($values[SmtpValues::KEY_PORT]);

        return $entity;
    }
}
