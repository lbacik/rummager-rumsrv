<?php

declare(strict_types=1);

namespace Rummager\Service\Host;

class HostEntityFactory
{
    const DEFAULT_N_VALUE = 1;
    const DEFAULT_T_VALUE = 1;
    const DEFAULT_S_VALUE = 0;

    public static function create(HostValues $values): Host
    {
        $host = new Host();

        $host->setName($values['name']());

        // TODO FIXME default values are defined in DB
        // unfortunately doctrine tries to include every entity field in insert statement
        // what causes problems when the value is null.
        // Should events be used here?
        // https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/events.html
        $host->setN($values[HostValues::KEY_NODES_QUANTITY] ?? self::DEFAULT_N_VALUE);
        $host->setT($values[HostValues::KEY_THREADS_QUANTITY] ?? self::DEFAULT_T_VALUE);
        $host->setS($values[HostValues::KEY_SENDERS_QUANTITY] ?? self::DEFAULT_S_VALUE);
        $host->setCreateTime(new \DateTime());

        return $host;
    }
}
