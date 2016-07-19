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


    function addData($key, $value)
    {
        $pair = $key . '=' . $value;

        if ($this->m_data == null) {
            $this->m_data = $pair;
        } else {
            $this->m_data = $this->m_data . '&' . $pair;
        }

    }

    function getData()
    {
        if ($this->m_data == null) {
            return "";
        } else {
            return $this->m_data;
        }
    }

    function getType()
    {
        return $this->m_type;
    }

    function getName()
    {
        return $this->m_name;
    }

    function isComplete()
    {
        return $this->m_completed;
    }

    abstract function complete();

    function isSuccess()
    {
        return strcmp($this->m_status, Message::SUCCESS) == 0;
    }

    function setStatus($status)
    {
        $this->m_status = $status;
    }

    function getStatus()
    {
        return $this->m_status;
    }

    function setTimestamp($timestamp)
    {
        $this->m_timestampInMillis = $timestamp;
    }

    function getTimestamp()
    {
        return $this->m_timestampInMillis;
    }
}