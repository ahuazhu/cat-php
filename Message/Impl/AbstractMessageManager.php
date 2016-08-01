<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/19  下午5:20
 */

namespace Message\Impl;


use Config\Config;
use Message\MessageManager;
use Message\peek;
use Message\Transaction;
use Transfer\Impl\SingleThreadSender;
use Utils\NetUtil;

abstract class AbstractMessageManager implements MessageManager
{

    private $m_domain;
    private $m_hostName;
    private $m_ip;


    public function __construct()
    {
        $this->m_domain = Config::getDomain();
        $this->m_hostName = NetUtil::getHostName();
        $this->m_ip = NetUtil::getIpAddress();

    }

    public function add($message)
    {
        $ctx = $this->getContext();
        if ($ctx != null) {
            $ctx->add($message);
        }
    }

    public function end(Transaction $transaction)
    {
        $ctx = $this->getContext();

        if ($ctx != null && $transaction->isStandalone()) {
            if ($ctx->end($this, $transaction)) {
                $this->removeLocalContext();
            }
        }
    }

    public function getPeekTransaction()
    {
        // TODO: Implement getPeekTransaction() method.
    }

    public function getThreadLocalMessageTree()
    {
        $ctx = $this->getContext();
        return $ctx->getTree();
    }

    public function hasContext()
    {

        $has = $this->getLocalContext() != null;
        if ($has) {
            $tree = $this->getLocalContext()->getTree();
            if ($tree == null) {
                return false;
            }
        }
        return $has;

    }

    public function reset()
    {
        return $this->removeLocalContext();
    }

    public function setup()
    {
        $ctx = null;

        if ($this->m_domain != null) {

            $ctx = new DefaultMessageContext($this->m_domain, $this->m_hostName, $this->m_ip);
        } else {
            $ctx = new DefaultMessageContext("Unknown", $this->m_hostName, $this->m_ip);
        }

        $this->setLocalContext($ctx);
    }

    public function start(Transaction $transaction)
    {
        assert($transaction instanceof Transaction, "Transaction accept only");

        $ctx = $this->getContext();
        $ctx->start($transaction);
    }

    public function getDomain()
    {
        return $this->m_domain;
    }


    public function flush($messageTree)
    {
        if ($messageTree->getMessageId() == null) {
            $messageTree->setMessageId(DefaultMessageIdFactory::getNextId());
        }

        $sender = new SingleThreadSender();
        $sender->send($messageTree);
    }

    private function getContext()
    {
        if ($this->getLocalContext() == null) {
            $this->setup();
        }

        return $this->getLocalContext();

    }


    protected abstract function getLocalContext();

    protected abstract function setLocalContext($context);

    protected abstract function removeLocalContext();
}