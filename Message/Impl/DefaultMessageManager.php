<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/19  上午11:03
 */

namespace Message\Impl;


use Message\Initializer;
use Message\message;
use Message\MessageManager;
use Message\peek;

class DefaultMessageManager implements MessageManager, Initializer
{

    public function init()
    {
        // TODO: Implement init() method.
    }

    public function add($message)
    {
        // TODO: Implement add() method.
    }

    public function end($transaction)
    {
        // TODO: Implement end() method.
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
        // TODO: Implement hasContext() method.
    }

    public function reset()
    {
        // TODO: Implement reset() method.
    }

    public function setup()
    {
        // TODO: Implement setup() method.
    }

    public function start($transaction)
    {
        // TODO: Implement start() method.
    }

    public function getDomain()
    {
        // TODO: Implement getDomain() method.
    }
}