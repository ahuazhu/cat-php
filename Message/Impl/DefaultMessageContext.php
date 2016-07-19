<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/19  下午5:05
 */

namespace Message\Impl;


use Message\Initializer;
use Message\MessageContext;
use Transfer\Impl\SingleThreadSender;
use Utils\Env;

class DefaultMessageContext implements MessageContext, Initializer
{
    private $m_messageTree;

    private $m_sender;

    private $m_tree;

    private $m_stack;

    private $m_length;


    public function __construct()
    {
        if (Env::isThreadSupport()) {

        } else {
            $this->m_sender = new SingleThreadSender();

        }

        $this->m_stack = new \SplStack();
        $this->m_length = 0;
        $this->m_messageTree = new DefaultMessageTree();
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
            $tree = $this->m_messageTree->copy();
            $tree->setMessage($message);
            $this->flush($tree);
        } else {
            $parent = $this->m_stack->top();
            $parent->addChild($message);
        }


    }

    public function end($messageManger, $transaction)
    {
        //TODO: Transaction end
    }

    public function start($transaction)
    {
        // TODO: Implement Transaction start() method.
    }

    public function getTree()
    {
        return $this->m_messageTree;
    }

    public function setTree($messageTree)
    {
        $this->m_messageTree = $messageTree;
    }

    public function flush($tree)
    {
        $this->m_sender->send($tree);
    }


}