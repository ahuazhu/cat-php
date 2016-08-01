<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/19  上午11:58
 */

namespace Message\Impl;


use Cat;
use Exception;
use Message\Transaction;
use Utils\TimeUtil;

class DefaultTransaction extends AbstractMessage implements Transaction
{

    private $m_durationInMicro = -1; // must be less than 0

    private $m_children;

    private $m_standalone;

    private $m_durationStart;

    public function __construct($type, $name, $messageManager)
    {
        parent::__construct($type, $name, $messageManager);
        $this->m_standalone = true;
        $this->m_durationStart = TimeUtil::currentTimeInMicro();
    }

    public function complete()
    {
        try {
            if (parent::isComplete()) {
                // complete() was called more than once
                $event = new DefaultEvent("cat", "BadInstrument", null);

                $event->setStatus("TransactionAlreadyCompleted");
                $event->complete();
                $this->addChild($event);
            } else {
                $this->m_durationInMicro = TimeUtil::currentTimeInMicro() - $this->m_durationStart;

                parent::setComplete(true);

                if (parent::getMessageManager() != null) {
                    parent::getMessageManager()->end($this);
                }
            }
        } catch (Exception $e) {
            // ignore
        }
    }

    public function addChild($message)
    {
        if ($this->m_children == null) {
            $this->m_children = array();
        }

        if ($message != null) {
            array_push($this->m_children, $message);
        } else {
            Cat::logError(null, null, new \Exception('null child message'));
        }
        return $this;
    }

    public function getChildren()
    {
        return $this->m_children;
    }

    public function getDurationInMicros()
    {
        return $this->m_durationInMicro;
    }

    public function getDurationInMillis()
    {
        return $this->m_durationInMicro / 1000;
    }

    public function hasChildren()
    {
        return $this->m_children != null && count($this->m_children) > 0;
    }

    public function isStandalone()
    {
        return $this->m_standalone;
    }
}