<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/19  上午11:13
 */

namespace Message\Impl;


use Message\MessageIdFactory;
use Message\MessageTree;
use Utils\ThreadUtil;

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

    public function __construct($domain, $hostName, $ipAddress)
    {
        $this->m_domain = $domain;
        $this->m_hostName = $hostName;
        $this->m_ipAddress = $ipAddress;

        $this->m_threadGroupName = ThreadUtil::getThreadGroupName();
        $this->m_threadId = ThreadUtil::getThreadId();
        $this->m_threadName = ThreadUtil::getThreadName();

        $this->m_messageId = DefaultMessageIdFactory::getNextId();

    }

    public function copy()
    {
        $tree = new DefaultMessageTree(null, null, null);

        $tree->setDomain($this->getDomain());
        $tree->setHostName($this->getHostName());
        $tree->setIpAddress($this->getIpAddress());
        $tree->setMessage($this->getMessage());
        $tree->setMessageId($this->getMessageId());
        $tree->setParentMessageId($this->getParentMessageId());
        $tree->setRootMessageId($this->getRootMessageId());
        $tree->setSessionToken($this->getSessionToken());
        $tree->setThreadGroupName($this->getThreadGroupName());
        $tree->setThreadId($this->getThreadId());
        $tree->setThreadName($this->getThreadName());

        return $tree;
    }

    public function getVersion()
    {
        return "PT1";
    }

    public function getDomain()
    {
        return $this->m_domain;
    }


    public function getHostName()
    {
        return $this->m_hostName;
    }

    public function getIpAddress()
    {
        return $this->m_ipAddress;
    }

    public function getSessionToken()
    {
        return $this->m_sessionToken;
    }

    public function getMessage()
    {
        return $this->m_message;
    }

    public function getMessageId()
    {
       return $this->m_messageId;
    }

    public function getParentMessageId()
    {
        return $this->m_parentMessageId;
    }

    public function getRootMessageId()
    {
        return $this->m_rootMessageId;
    }

    public function getThreadGroupName()
    {
       return $this->m_threadGroupName;
    }

    public function getThreadId()
    {
       return $this->m_threadId;
    }

    public function getThreadName()
    {
        return $this->m_threadName;
    }

    public function setDomain($domain)
    {
        $this->m_domain = $domain;
    }


    public function setHostName($hostName)
    {
        $this->m_hostName = $hostName;
    }

    public function setIpAddress($ipAddress)
    {
        $this->m_ipAddress = $ipAddress;
    }

    public function setMessage($message)
    {
       $this->m_message = $message;
    }

    public function setMessageId($messageId)
    {
        $this->m_messageId = $messageId;
    }

    public function setSessionToken($session)
    {
        $this->m_message = $session;
    }

    public function setParentMessageId($parentMessageId)
    {
        $this->m_parentMessageId = $parentMessageId;
    }

    public function setRootMessageId($rootMessageId)
    {
        $this->m_rootMessageId = $rootMessageId;
    }

    public function setThreadGroupName($threadGroupName)
    {
        $this->m_threadGroupName = $threadGroupName;
    }

    public function setThreadId($threadId)
    {
        $this->m_threadId = $threadId;
    }


    public function setThreadName($id)
    {
        $this->m_threadName = $id;
    }
}