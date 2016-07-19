<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/19  上午11:18
 */

namespace Message\NullImpl;


use Message\MessageTree;

class NullMessageTree implements MessageTree
{
    const  UNKNOWN = "Unknown";

    const  UNKNOWN_MESSAGE_ID = UNKNOWN + "-00000000-000000-0";


    public function copy()
    {
        return $this;
    }

    public function getDomain()
    {
        return self::UNKNOWN;
    }

    public function getFormatMessageId()
    {
        return null;
    }

    public function getHostName()
    {
        return "localhost";
    }

    public function getIpAddress()
    {
        return "127.0.0.1";
    }

    public function getSessionToken()
    {
        return '';
    }

    public function getMessage()
    {
        return null;
    }

    public function getMessageId()
    {
        return UNKNOWN_MESSAGE_ID;
    }

    public function getParentMessageId()
    {
        return UNKNOWN_MESSAGE_ID;
    }

    public function getRootMessageId()
    {
        return UNKNOWN_MESSAGE_ID;
    }

    public function getThreadGroupName()
    {
        return '';
    }

    public function getThreadId()
    {
        return '';
    }

    public function getThreadName()
    {
        return '';
    }

    public function setDomain($domain)
    {
    }

    public function setFormatMessageId($messageId)
    {
    }

    public function setHostName($hostName)
    {
    }

    public function setIpAddress($ipAddress)
    {
    }

    public function setMessage($message)
    {
    }

    public function setMessageId($messageId)
    {
    }

    public function setSessionToken($session)
    {
    }

    public function setParentMessageId($parentMessageId)
    {
    }

    public function setRootMessageId($rootMessageId)
    {
    }

    public function setThreadGroupName($name)
    {
    }

    public function setThreadId($threadId)
    {
    }

    public function setThreadName($id)
    {
    }
}