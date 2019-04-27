<?php

declare(strict_types=1);

namespace Rummager\Service\Module\Smtp;

use Rummager\Service\Module\ModuleBase;
use Rummager\Service\Network\Ip;

class Smtp extends ModuleBase
{
    protected $id = 1;

    /** @var ModuleSmtpRepositoryInterface */
    protected $repository;

    public function __construct(ModuleSmtpRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function save(array $data): void
    {
        $smtp = SmtpValues::create(...$data);
        $this->repository->add($smtp);
    }

    public function lastIp(string $networkIp, string $broadcast): string
    {
        $ip = Ip::create($networkIp);
        $brd = Ip::create($broadcast);

        return $this->repository->lastIp($ip, $brd);
    }
}
