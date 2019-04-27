<?php

namespace Rummager\Service\Network;

/**
 * Ipv4Reserved
 */
class Ipv4Reserved
{
    /**
     * @var string
     */
    private $ip;

    /**
     * @var int
     */
    private $mask;


    /**
     * Set ip.
     *
     * @param string $ip
     *
     * @return Ipv4Reserved
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip.
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set mask.
     *
     * @param int $mask
     *
     * @return Ipv4Reserved
     */
    public function setMask($mask)
    {
        $this->mask = $mask;

        return $this;
    }

    /**
     * Get mask.
     *
     * @return int
     */
    public function getMask()
    {
        return $this->mask;
    }
}
