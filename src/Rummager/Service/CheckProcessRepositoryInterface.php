<?php

declare(strict_types=1);

namespace Rummager\Service;

use Rummager\Service\CheckProcess\CheckIdentity;
use Rummager\Service\CheckProcess\CheckValues;
use Rummager\Service\Check as CheckEntity;

interface CheckProcessRepositoryInterface
{
    public function add(CheckValues $checkValueObject): CheckEntity;
    public function get(CheckIdentity $checkIdentity): CheckEntity;
}
