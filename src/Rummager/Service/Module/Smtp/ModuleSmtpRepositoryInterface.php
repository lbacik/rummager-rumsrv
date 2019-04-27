<?php

declare(strict_types=1);

namespace Rummager\Service\Module\Smtp;

use Rummager\Service\Network\Ip;

interface ModuleSmtpRepositoryInterface
{
    public function add(SmtpValues $smtp): void;
    public function lastIp(Ip $networkIp, Ip $broadcast): string;
}
