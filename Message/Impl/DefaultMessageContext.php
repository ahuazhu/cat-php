<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/19  下午5:05
 */

namespace Message\Impl;


use Message\MessageContext;
use Transfer\Impl\SingleThreadSender;
use Utils\Env;

class DefaultMessageContext implements MessageContext
{
    private $m_sender;

    private $m_tree;

    private $m_stack;

    private $m_length;

    private $m_totalDurationInMicros;


    public function __construct($domain, $hostName = null, $ipAddress = null)
    {
        if (Env::isThreadSupport()) {

        } else {
            $this->m_sender = new SingleThreadSender();

        }

        $this->m_stack = new \SplStack();
        $this->m_length = 0;

        $this->m_tree = new DefaultMessageTree($domain, $hostName, $ipAddress);
    }

    public function init()
    {
        if (Env::isThreadSupport()) {

        } else {
            $this->m_sender = new SingleThreadSender();
            $this->m_stack = new \SplStack();
            $this->m_length = 0;
        }

        return $this;
    }

    public function add($message)
    {
        if ($this->m_stack->isEmpty()) {
            $tree = $this->m_tree->copy();
            $tree->setMessage($message);
            $this->flush($tree);
        } else {
            $parent = $this->m_stack->top();
            $parent->addChild($message);
        }


    }

    public function end($messageManger, $transaction)
    {
        if (!$this->m_stack->isEmpty()) {
            $current = $this->m_stack->pop();

            if ($this->m_stack->isEmpty()) {
                $tree = $this->m_tree->copy();

                $this->m_tree->setMessageId(null);
                $this->m_tree->setMessage(null);
                $tree->setMessage($transaction);
                $messageManger->flush($tree);
                return true;
            }
        }
    }

    public function start($transaction)
    {
        if (!$this->m_stack->isEmpty()) {

            $parent = $this->m_stack->top();
            $parent->addChild($transaction);
        } else {
            $this->m_tree->setMessage($transaction);
        }

        $this->m_stack->push($transaction);
    }

    public function getTree()
    {
        return $this->m_tree;
    }

    public function setTree($messageTree)
    {
        $this->m_tree = $messageTree;
    }

    public function flush($tree)
    {
        $this->m_sender->send($tree);
    }




}