<?php

declare(strict_types=1);

namespace Rummager\Service\Module\Smtp;

use Rummager\Service\Check;
use Rummager\Infrastructure\EmptyValueObject;

class SmtpValues extends EmptyValueObject
{
    const KEY_CHECK = 'check';
    const KEY_IP = 'ip';
    const KEY_PORT = 'port';
    const KEY_HELO = 'help';
    const KEY_HELO_CODE = 'helo-code';
    const KEY_EHLO = 'ehlo';
    const KEY_EHLO_CODE = 'ehlo-code';
    const KEY_GREETINGS_CODE = 'greetings-code';
    const KEY_GREETINGS_TEXT = 'greetings-text';
    const KEY_CHECKTIME = 'checktime';
    const KEY_TSTART = 'tstart';
    const KEY_TCON = 'tcon';
    const KEY_TEND = 'tend';

    protected $keys = [
        self::KEY_CHECK => 'instance_of:' . Check::class,
        self::KEY_IP => 'numeric',
        self::KEY_PORT => 'integer',
        self::KEY_HELO => 'nullable|string',
        self::KEY_HELO_CODE => 'nullable|integer',
        self::KEY_EHLO => 'nullable|string',
        self::KEY_EHLO_CODE => 'nullable|string|max:45',
        self::KEY_GREETINGS_CODE => 'nullable|integer',
        self::KEY_GREETINGS_TEXT => 'nullable',
        self::KEY_CHECKTIME => 'nullable',
        self::KEY_TSTART => 'nullable',
        self::KEY_TCON => 'nullable',
        self::KEY_TEND => 'nullable',
    ];

    public static function create(
        $check,
        $ip,
        $port,
        $helo,
        $heloCode,
        $ehlo,
        $ehloCode,
        $greetingsCode,
        $greetingsText,
        $checkTime,
        $tstart,
        $tcon,
        $tend
    ): SmtpValues {
        return new self([
            self::KEY_CHECK => $check,
            self::KEY_IP => $ip,
            self::KEY_PORT => $port,
            self::KEY_HELO => $helo,
            self::KEY_HELO_CODE => $heloCode,
            self::KEY_EHLO => $ehlo,
            self::KEY_EHLO_CODE => $ehloCode,
            self::KEY_GREETINGS_CODE => $greetingsCode,
            self::KEY_GREETINGS_TEXT => $greetingsText,
            self::KEY_CHECKTIME => $checkTime,
            self::KEY_TSTART => $tstart,
            self::KEY_TCON => $tcon,
            self::KEY_TEND => $tend,
        ]);
    }
}
