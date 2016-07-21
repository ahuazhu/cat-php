<?php
use Message\Impl\DefaultMessageIdFactory;

/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/19  下午2:23
 */

function __autoload($class)
{
    $path = str_replace("\\", "/", $class);
    require_once($path . '.php');
}


function test()
{
    return 1 / 0;
    throw new Exception;
}

try {
    test();

} catch (Exception $e) {
    Cat::logError('Error', get_class($e), $e);
}