<?php

declare(strict_types=1);

namespace Rummager\Behat\Base;

class Result
{
    private static $instance = null;

    private $value;

    /**
     * @param mixed $result
     */
    public function setValue($result): void
    {
        $this->value = $result;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
