<?php

namespace Rummager\Module;

/**
 * SmtpSender
 */
class SmtpSender
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $msg;

    /**
     * @var string|null
     */
    private $conn_log;

    /**
     * @var \DateTime|null
     */
    private $create_time;

    /**
     * @var \DateTime|null
     */
    private $last_update;

    /**
     * @var \Rummager\Service\Check
     */
    private $check;

    /**
     * @var \Rummager\Module\Smtp
     */
    private $smtp;

    /**
     * @var \Rummager\Module\SmtpSenderStatus
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
     * Set msg.
     *
     * @param string $msg
     *
     * @return SmtpSender
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;

        return $this;
    }

    /**
     * Get msg.
     *
     * @return string
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * Set connLog.
     *
     * @param string|null $connLog
     *
     * @return SmtpSender
     */
    public function setConnLog($connLog = null)
    {
        $this->conn_log = $connLog;

        return $this;
    }

    /**
     * Get connLog.
     *
     * @return string|null
     */
    public function getConnLog()
    {
        return $this->conn_log;
    }

    /**
     * Set createTime.
     *
     * @param \DateTime|null $createTime
     *
     * @return SmtpSender
     */
    public function setCreateTime($createTime = null)
    {
        $this->create_time = $createTime;

        return $this;
    }

    /**
     * Get createTime.
     *
     * @return \DateTime|null
     */
    public function getCreateTime()
    {
        return $this->create_time;
    }

    /**
     * Set lastUpdate.
     *
     * @param \DateTime|null $lastUpdate
     *
     * @return SmtpSender
     */
    public function setLastUpdate($lastUpdate = null)
    {
        $this->last_update = $lastUpdate;

        return $this;
    }

    /**
     * Get lastUpdate.
     *
     * @return \DateTime|null
     */
    public function getLastUpdate()
    {
        return $this->last_update;
    }

    /**
     * Set check.
     *
     * @param \Rummager\Service\Check $check
     *
     * @return SmtpSender
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

    /**
     * Set smtp.
     *
     * @param \Rummager\Module\Smtp $smtp
     *
     * @return SmtpSender
     */
    public function setSmtp(\Rummager\Module\Smtp $smtp)
    {
        $this->smtp = $smtp;

        return $this;
    }

    /**
     * Get smtp.
     *
     * @return \Rummager\Module\Smtp
     */
    public function getSmtp()
    {
        return $this->smtp;
    }

    /**
     * Set status.
     *
     * @param \Rummager\Module\SmtpSenderStatus|null $status
     *
     * @return SmtpSender
     */
    public function setStatus(\Rummager\Module\SmtpSenderStatus $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return \Rummager\Module\SmtpSenderStatus|null
     */
    public function getStatus()
    {
        return $this->status;
    }
}
