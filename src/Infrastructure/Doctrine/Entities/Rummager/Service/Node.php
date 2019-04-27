<?php

namespace Rummager\Service;

/**
 * Node
 */
class Node
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $cid;

    /**
     * @var \DateTime
     */
    private $stime;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $checks;

    /**
     * @var \Rummager\Service\NodeStatus
     */
    private $status;

    /**
     * @var \Rummager\Service\Host\Host
     */
    private $host;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->checks = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set cid.
     *
     * @param int $cid
     *
     * @return Node
     */
    public function setCid($cid)
    {
        $this->cid = $cid;

        return $this;
    }

    /**
     * Get cid.
     *
     * @return int
     */
    public function getCid()
    {
        return $this->cid;
    }

    /**
     * Set stime.
     *
     * @param \DateTime $stime
     *
     * @return Node
     */
    public function setStime($stime)
    {
        $this->stime = $stime;

        return $this;
    }

    /**
     * Get stime.
     *
     * @return \DateTime
     */
    public function getStime()
    {
        return $this->stime;
    }

    /**
     * Add check.
     *
     * @param \Rummager\Service\Check $check
     *
     * @return Node
     */
    public function addCheck(\Rummager\Service\Check $check)
    {
        $this->checks[] = $check;

        return $this;
    }

    /**
     * Remove check.
     *
     * @param \Rummager\Service\Check $check
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCheck(\Rummager\Service\Check $check)
    {
        return $this->checks->removeElement($check);
    }

    /**
     * Get checks.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChecks()
    {
        return $this->checks;
    }

    /**
     * Set status.
     *
     * @param \Rummager\Service\NodeStatus|null $status
     *
     * @return Node
     */
    public function setStatus(\Rummager\Service\NodeStatus $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return \Rummager\Service\NodeStatus|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set host.
     *
     * @param \Rummager\Service\Host\Host|null $host
     *
     * @return Node
     */
    public function setHost(\Rummager\Service\Host\Host $host = null)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get host.
     *
     * @return \Rummager\Service\Host\Host|null
     */
    public function getHost()
    {
        return $this->host;
    }
}
