<?php

namespace Rummager\Module;

/**
 * Smtp
 */
class Smtp
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $ip;

    /**
     * @var int
     */
    private $port;

    /**
     * @var string|null
     */
    private $helo;

    /**
     * @var int|null
     */
    private $helo_code;

    /**
     * @var string|null
     */
    private $ehlo;

    /**
     * @var string|null
     */
    private $ehlo_code;

    /**
     * @var int|null
     */
    private $greetings_code;

    /**
     * @var string|null
     */
    private $greetings_text;

    /**
     * @var \DateTime|null
     */
    private $checktime;

    /**
     * @var \DateTime|null
     */
    private $tstart;

    /**
     * @var \DateTime|null
     */
    private $tcon;

    /**
     * @var \DateTime|null
     */
    private $tend;

    /**
     * @var \Rummager\Service\Check
     */
    private $check;


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
     * @param int $ip
     *
     * @return Smtp
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip.
     *
     * @return int
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set port.
     *
     * @param int $port
     *
     * @return Smtp
     */
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * Get port.
     *
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Set helo.
     *
     * @param string|null $helo
     *
     * @return Smtp
     */
    public function setHelo($helo = null)
    {
        $this->helo = $helo;

        return $this;
    }

    /**
     * Get helo.
     *
     * @return string|null
     */
    public function getHelo()
    {
        return $this->helo;
    }

    /**
     * Set heloCode.
     *
     * @param int|null $heloCode
     *
     * @return Smtp
     */
    public function setHeloCode($heloCode = null)
    {
        $this->helo_code = $heloCode;

        return $this;
    }

    /**
     * Get heloCode.
     *
     * @return int|null
     */
    public function getHeloCode()
    {
        return $this->helo_code;
    }

    /**
     * Set ehlo.
     *
     * @param string|null $ehlo
     *
     * @return Smtp
     */
    public function setEhlo($ehlo = null)
    {
        $this->ehlo = $ehlo;

        return $this;
    }

    /**
     * Get ehlo.
     *
     * @return string|null
     */
    public function getEhlo()
    {
        return $this->ehlo;
    }

    /**
     * Set ehloCode.
     *
     * @param string|null $ehloCode
     *
     * @return Smtp
     */
    public function setEhloCode($ehloCode = null)
    {
        $this->ehlo_code = $ehloCode;

        return $this;
    }

    /**
     * Get ehloCode.
     *
     * @return string|null
     */
    public function getEhloCode()
    {
        return $this->ehlo_code;
    }

    /**
     * Set greetingsCode.
     *
     * @param int|null $greetingsCode
     *
     * @return Smtp
     */
    public function setGreetingsCode($greetingsCode = null)
    {
        $this->greetings_code = $greetingsCode;

        return $this;
    }

    /**
     * Get greetingsCode.
     *
     * @return int|null
     */
    public function getGreetingsCode()
    {
        return $this->greetings_code;
    }

    /**
     * Set greetingsText.
     *
     * @param string|null $greetingsText
     *
     * @return Smtp
     */
    public function setGreetingsText($greetingsText = null)
    {
        $this->greetings_text = $greetingsText;

        return $this;
    }

    /**
     * Get greetingsText.
     *
     * @return string|null
     */
    public function getGreetingsText()
    {
        return $this->greetings_text;
    }

    /**
     * Set checktime.
     *
     * @param \DateTime|null $checktime
     *
     * @return Smtp
     */
    public function setChecktime($checktime = null)
    {
        $this->checktime = $checktime;

        return $this;
    }

    /**
     * Get checktime.
     *
     * @return \DateTime|null
     */
    public function getChecktime()
    {
        return $this->checktime;
    }

    /**
     * Set tstart.
     *
     * @param \DateTime|null $tstart
     *
     * @return Smtp
     */
    public function setTstart($tstart = null)
    {
        $this->tstart = $tstart;

        return $this;
    }

    /**
     * Get tstart.
     *
     * @return \DateTime|null
     */
    public function getTstart()
    {
        return $this->tstart;
    }

    /**
     * Set tcon.
     *
     * @param \DateTime|null $tcon
     *
     * @return Smtp
     */
    public function setTcon($tcon = null)
    {
        $this->tcon = $tcon;

        return $this;
    }

    /**
     * Get tcon.
     *
     * @return \DateTime|null
     */
    public function getTcon()
    {
        return $this->tcon;
    }

    /**
     * Set tend.
     *
     * @param \DateTime|null $tend
     *
     * @return Smtp
     */
    public function setTend($tend = null)
    {
        $this->tend = $tend;

        return $this;
    }

    /**
     * Get tend.
     *
     * @return \DateTime|null
     */
    public function getTend()
    {
        return $this->tend;
    }

    /**
     * Set check.
     *
     * @param \Rummager\Service\Check $check
     *
     * @return Smtp
     */
    public function setCheck(\Rummager\Service\Check $check)
    {
        $this->check = $check;

        return $this;
    }

    /**
     * Get check.
     *
     * @return \Rummager\Service\Check
     */
    public function getCheck()
    {
        return $this->check;
    }
}
