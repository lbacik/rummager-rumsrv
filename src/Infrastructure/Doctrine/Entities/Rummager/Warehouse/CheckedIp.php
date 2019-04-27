<?php

namespace Rummager\Warehouse;

/**
 * CheckedIp
 */
class CheckedIp
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $hostid;

    /**
     * @var int
     */
    private $hosts;

    /**
     * @var int
     */
    private $smtp;


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
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return CheckedIp
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set hostid.
     *
     * @param string $hostid
     *
     * @return CheckedIp
     */
    public function setHostid($hostid)
    {
        $this->hostid = $hostid;

        return $this;
    }

    /**
     * Get hostid.
     *
     * @return string
     */
    public function getHostid()
    {
        return $this->hostid;
    }

    /**
     * Set hosts.
     *
     * @param int $hosts
     *
     * @return CheckedIp
     */
    public function setHosts($hosts)
    {
        $this->hosts = $hosts;

        return $this;
    }

    /**
     * Get hosts.
     *
     * @return int
     */
    public function getHosts()
    {
        return $this->hosts;
    }

    /**
     * Set smtp.
     *
     * @param int $smtp
     *
     * @return CheckedIp
     */
    public function setSmtp($smtp)
    {
        $this->smtp = $smtp;

        return $this;
    }

    /**
     * Get smtp.
     *
     * @return int
     */
    public function getSmtp()
    {
        return $this->smtp;
    }
}
