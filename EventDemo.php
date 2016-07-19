<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/19  下午2:23
 */

function __autoload($class)
{
    $path = str_replace("\\", "/", $class);
    require_once($path.'.php');
}


$event = Cat::newEvent('TestType', 'TestName');

$event->addData("test", "test");

$event->complete();


