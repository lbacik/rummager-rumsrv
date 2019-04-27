<?php

namespace Rummager\Service\Host;

/**
 * Host
 */
class Host
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $n = 1;

    /**
     * @var int
     */
    private $t = 1;

    /**
     * @var int
     */
    private $s = 0;

    /**
     * @var \DateTime
     */
    private $createTime = 'CURRENT_TIMESTAMP';

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $nodes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->nodes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name.
     *
     * @param string $name
     *
     * @return Host
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set n.
     *
     * @param int $n
     *
     * @return Host
     */
    public function setN($n)
    {
        $this->n = $n;

        return $this;
    }

    /**
     * Get n.
     *
     * @return int
     */
    public function getN()
    {
        return $this->n;
    }

    /**
     * Set t.
     *
     * @param int $t
     *
     * @return Host
     */
    public function setT($t)
    {
        $this->t = $t;

        return $this;
    }

    /**
     * Get t.
     *
     * @return int
     */
    public function getT()
    {
        return $this->t;
    }

    /**
     * Set s.
     *
     * @param int $s
     *
     * @return Host
     */
    public function setS($s)
    {
        $this->s = $s;

        return $this;
    }

    /**
     * Get s.
     *
     * @return int
     */
    public function getS()
    {
        return $this->s;
    }

    /**
     * Set createTime.
     *
     * @param \DateTime $createTime
     *
     * @return Host
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
     * Add node.
     *
     * @param \Rummager\Service\Node $node
     *
     * @return Host
     */
    public function addNode(\Rummager\Service\Node $node)
    {
        $this->nodes[] = $node;

        return $this;
    }

    /**
     * Remove node.
     *
     * @param \Rummager\Service\Node $node
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeNode(\Rummager\Service\Node $node)
    {
        return $this->nodes->removeElement($node);
    }

    /**
     * Get nodes.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNodes()
    {
        return $this->nodes;
    }
}
