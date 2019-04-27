<?php

declare(strict_types=1);

namespace Rummager\Infrastructure;

class OneValueValueObject extends EmptyValueObject
{
    const KEY_VALUE = 'value';

    public function __invoke()
    {
        return $this[self::KEY_VALUE];
    }

    /**
     * @param mixed $value
     */
    public static function create($value): self
    {
        return new static([self::KEY_VALUE => $value]);
    }
}
