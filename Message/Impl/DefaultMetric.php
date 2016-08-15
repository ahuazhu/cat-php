<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/8/15  下午4:32
 */

namespace Message\Impl;


use Message\Metric;

class DefaultMetric extends AbstractMessage implements Metric
{

    public function __construct($type, $name, $messageManager)
    {
        parent::__construct($type, $name, $messageManager);
    }


    public function complete()
    {
        parent::setComplete(true);

        if (parent::getMessageManager() != null) {
            parent::getMessageManager()->add($this);
        }
    }
}