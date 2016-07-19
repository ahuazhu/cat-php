<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/19  上午11:13
 */

namespace Message\Impl;


use Message\MessageTree;

class DefaultMessageTree implements MessageTree
{
    private $m_domain;

    private $m_hostName;

    private $m_ipAddress;

    private $m_message;

    private $m_messageId;

    private $m_parentMessageId;

    private $m_rootMessageId;

    private $m_sessionToken;

    private $m_threadGroupName;

    private $m_threadId;

    private $m_threadName;

    public function copy()
    {
        // TODO: Implement copy() method.
    }

    public function getDomain()
    {
        // TODO: Implement getDomain() method.
    }

    public function getFormatMessageId()
    {
        // TODO: Implement getFormatMessageId() method.
    }

    public function getHostName()
    {
        // TODO: Implement getHostName() method.
    }

    public function getIpAddress()
    {
        // TODO: Implement getIpAddress() method.
    }

    public function getSessionToken()
    {
        // TODO: Implement getSessionToken() method.
    }

    public function getMessage()
    {
        // TODO: Implement getMessage() method.
    }

    public function getMessageId()
    {
        // TODO: Implement getMessageId() method.
    }

    public function getParentMessageId()
    {
        // TODO: Implement getParentMessageId() method.
    }

    public function getRootMessageId()
    {
        // TODO: Implement getRootMessageId() method.
    }

    public function getThreadGroupName()
    {
        // TODO: Implement getThreadGroupName() method.
    }

    public function getThreadId()
    {
        // TODO: Implement getThreadId() method.
    }

    public function getThreadName()
    {
        // TODO: Implement getThreadName() method.
    }

    public function setDomain($domain)
    {
        // TODO: Implement setDomain() method.
    }

    public function setFormatMessageId($messageId)
    {
        // TODO: Implement setFormatMessageId() method.
    }

    public function setHostName($hostName)
    {
        // TODO: Implement setHostName() method.
    }

    public function setIpAddress($ipAddress)
    {
        // TODO: Implement setIpAddress() method.
    }

    public function setMessage($message)
    {
        // TODO: Implement setMessage() method.
    }

    public function setMessageId($messageId)
    {
        // TODO: Implement setMessageId() method.
    }

    public function setSessionToken($session)
    {
        // TODO: Implement setSessionToken() method.
    }

    public function setParentMessageId($parentMessageId)
    {
        // TODO: Implement setParentMessageId() method.
    }

    public function setRootMessageId($rootMessageId)
    {
        // TODO: Implement setRootMessageId() method.
    }

    public function setThreadGroupName($name)
    {
        // TODO: Implement setThreadGroupName() method.
    }

    public function setThreadId($threadId)
    {
        // TODO: Implement setThreadId() method.
    }

    public function setThreadName($id)
    {
        // TODO: Implement setThreadName() method.
    }
}