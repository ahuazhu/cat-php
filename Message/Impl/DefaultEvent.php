<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/19  下午12:40
 */

namespace Message\Impl;


use Message\Event;

class DefaultEvent extends AbstractMessage
{

    public function __construct($type, $name)
    {
        parent::__construct($type, $name);
    }

    function complete()
    {
        // TODO: Implement complete() method.
    }
}