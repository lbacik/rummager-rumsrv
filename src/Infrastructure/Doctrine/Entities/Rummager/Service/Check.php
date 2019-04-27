<?php

namespace Rummager\Service;

/**
 * Check
 */
class Check
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $createTime = 'CURRENT_TIMESTAMP';

    /**
     * @var \Rummager\Service\Node
     */
    private $node;

    /**
     * @var \Rummager\Service\Module\Module
     */
    private $module;

    /**
     * @var \Rummager\Service\Network\Ipv4Class
     */
    private $net;


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
     * Set createTime.
     *
     * @param \DateTime $createTime
     *
     * @return Check
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;

        return $this;
    }

    /**
     * Get createTime.
     *
     * @return \DateTime
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * Set node.
     *
     * @param \Rummager\Service\Node $node
     *
     * @return Check
     */
    public function setNode(\Rummager\Service\Node $node)
    {
        $this->node = $node;

        return $this;
    }

    /**
     * Get node.
     *
     * @return \Rummager\Service\Node
     */
    public function getNode()
    {
        return $this->node;
    }

    /**
     * Set module.
     *
     * @param \Rummager\Service\Module\Module $module
     *
     * @return Check
     */
    public function setModule(\Rummager\Service\Module\Module $module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module.
     *
     * @return \Rummager\Service\Module\Module
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set net.
     *
     * @param \Rummager\Service\Network\Ipv4Class|null $net
     *
     * @return Check
     */
    public function setNet(\Rummager\Service\Network\Ipv4Class $net = null)
    {
        $this->net = $net;

        return $this;
    }

    /**
     * Get net.
     *
     * @return \Rummager\Service\Network\Ipv4Class|null
     */
    public function getNet()
    {
        return $this->net;
    }
}
