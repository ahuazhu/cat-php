<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/19  上午11:03
 */

namespace Message\Impl;


use Message\Initializer;
use Message\MessageManager;
use Message\peek;
use Message\Transaction;

class SingleThreadMessageManager extends AbstractMessageManager
{


    private $m_context;

    protected function getLocalContext()
    {
        return $this->m_context;
    }

    protected function setLocalContext($context)
    {
        $this->m_context = $context;
    }

    protected function removeLocalContext()
    {
        $this->m_context = null;
    }
}