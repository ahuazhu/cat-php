<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/19  下午12:40
 */

namespace Message\Impl;


use Message\Event;

class DefaultEvent extends AbstractMessage implements Event
{

    public function __construct($type, $name, $messageManager)
    {
        parent::__construct($type, $name, $messageManager);
    }

    function complete()
    {
        parent::setComplete(true);

        if (parent::getMessageManager() != null) {
            parent::getMessageManager()->add($this);
        }
    }
}