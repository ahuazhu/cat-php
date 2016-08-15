<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/19  下午1:43
 */

namespace Message;


interface MessageProducer
{

    public function newEvent($type, $name);

    public function newMetric($type, $name);
}