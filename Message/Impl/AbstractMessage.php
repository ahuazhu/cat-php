<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/19  下午12:42
 */

namespace Message\Impl;


use Message\Message;

abstract class AbstractMessage implements Message
{

    private $m_type;

    private $m_name;

    protected $m_status = "unset";

    private $m_timestampInMillis;

    private $m_data;

    private $m_completed;

    private $m_manager;

    public function __construct($type, $name, $messageManager)
    {
        $this->m_type = $type;
        $this->m_name = $name;
        $this->m_manager = $messageManager;
    }


    public function addData($key, $value)
    {
        $pair = $key . '=' . $value;

        if ($this->m_data == null) {
            $this->m_data = $pair;
        } else {
            $this->m_data = $this->m_data . '&' . $pair;
        }

    }

    public function getData()
    {
        if ($this->m_data == null) {
            return "";
        } else {
            return $this->m_data;
        }
    }

    public function getType()
    {
        return $this->m_type;
    }

    public function getName()
    {
        return $this->m_name;
    }

    public function isComplete()
    {
        return $this->m_completed;
    }

    public abstract function complete();

    public function isSuccess()
    {
        return strcmp($this->m_status, Message::SUCCESS) == 0;
    }

    public function setStatus($status)
    {
        $this->m_status = $status;
    }

    public function getStatus()
    {
        return $this->m_status;
    }

    public function setTimestamp($timestamp)
    {
        $this->m_timestampInMillis = $timestamp;
    }

    public function getTimestamp()
    {
        return $this->m_timestampInMillis;
    }

    public function getMessageManager()
    {
        return $this->m_manager;
    }

    public function setComplete($completed)
    {
        $this->m_completed = $completed;
    }
}