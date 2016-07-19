<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/19  下午5:20
 */

namespace Message\Impl;


use Message\Initializer;
use Message\message;
use Message\MessageManager;
use Message\peek;
use Message\Transaction;

abstract class AbstractMessageManager implements MessageManager, Initializer
{

    private $m_domain;
    private $m_hostName;
    private $m_ip;

    public function init()
    {
        // TODO: Implement init() method.
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
            if ($ctx . end($this, $transaction)) {
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
        // TODO: Implement getThreadLocalMessageTree() method.
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
        // TODO: Implement reset() method.
    }

    public function setup()
    {
        // TODO: Implement setup() method.
    }

    public function start(Transaction $transaction)
    {
        // TODO: Implement start() method.

        assert($transaction instanceof Transaction, "Transaction accept only");



    }

    public function getDomain()
    {
        return $this->m_domain;
    }

    private function getContext()
    {
        if ($this->getLocalContext() != null) {
            return $this->getLocalContext();
        }

        if ($this->m_domain != null) {
           $this->setLocalContext(new DefaultMessageContext($this->m_domain, $this->m_hostName, $this->m_ip));
        } else {
            $this->setLocalContext(new DefaultMessageContext("Unknown", m_hostName, ""));
        }

        return $this->m_context;
    }

    protected abstract function getLocalContext();
    protected abstract function setLocalContext($context);
    protected abstract function removeLocalContext();
}