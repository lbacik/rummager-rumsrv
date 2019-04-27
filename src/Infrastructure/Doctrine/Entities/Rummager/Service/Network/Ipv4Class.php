<?php

namespace Rummager\Service\Network;

/**
 * Ipv4Class
 */
class Ipv4Class
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $ip;

    /**
     * @var string
     */
    private $mask;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \Rummager\Service\Network\Ipv4ClassStatus
     */
    private $status;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ip.
     *
     * @param string $ip
     *
     * @return Ipv4Class
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
     * @param string $mask
     *
     * @return Ipv4Class
     */
    public function setMask($mask)
    {
        $this->mask = $mask;

        return $this;
    }

    /**
     * Get mask.
     *
     * @return string
     */
    public function getMask()
    {
        return $this->mask;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Ipv4Class
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set status.
     *
     * @param \Rummager\Service\Network\Ipv4ClassStatus|null $status
     *
     * @return Ipv4Class
     */
    public function setStatus(\Rummager\Service\Network\Ipv4ClassStatus $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return \Rummager\Service\Network\Ipv4ClassStatus|null
     */
    public function getStatus()
    {
        return $this->status;
    }
}
