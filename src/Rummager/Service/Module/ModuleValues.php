<?php

declare(strict_types=1);

namespace Rummager\Service\Module;

use Rummager\Infrastructure\EmptyValueObject;

class ModuleValues extends EmptyValueObject
{
    const KEY_NAME = 'name';
    const KEY_RESULT_TAB = 'result_tab';

    protected array $keys = [
        self::KEY_NAME => 'instance_of:' . ModuleName::class,
        self::KEY_RESULT_TAB => 'string|max:45',
    ];

    public static function create(
        ModuleName $moduleName,
        string $resultTab
    ): self {
        return new self([
            self::KEY_NAME => $moduleName,
            self::KEY_RESULT_TAB => $resultTab,
        ]);
    }
}
