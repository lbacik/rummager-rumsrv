<?php

namespace Rummager\Service\Module;

/**
 * Module
 */
class Module
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
     * @var string
     */
    private $result_tab;


    /**
     * Set id.
     *
     * @param int $id
     *
     * @return Module
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * @return Module
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
     * Set resultTab.
     *
     * @param string $resultTab
     *
     * @return Module
     */
    public function setResultTab($resultTab)
    {
        $this->result_tab = $resultTab;

        return $this;
    }

    /**
     * Get resultTab.
     *
     * @return string
     */
    public function getResultTab()
    {
        return $this->result_tab;
    }
}
