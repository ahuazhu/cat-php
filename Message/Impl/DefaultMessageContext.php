<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/19  下午5:05
 */

namespace Message\Impl;


use Message\Initializer;
use Message\MessageContext;

class DefaultMessageContext implements MessageContext, Initializer
{
    private $m_messageTree;

    private $m_sender;

    private $m_codec;

    public function init()
    {
        // TODO: Implement init() method.
    }

    public function add($message)
    {
        // TODO: Implement add() method.
    }

    public function end($messageManger, $transaction)
    {
        // TODO: Implement end() method.
    }

    public function start($transaction)
    {
        // TODO: Implement start() method.
    }

    public function getTree()
    {
        return $this->m_messageTree;
    }

    public function setTree($messageTree)
    {
        $this->m_messageTree = $messageTree;
    }

    public function flush()
    {
        // TODO: Implement flush() method.
    }


}