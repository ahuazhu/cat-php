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


interface Demo
{
    public function run();
}


function test()
{
    throw new Exception;
}

try {
    $a = test();

    echo $a;

    echo "hello, world!!!\n";


} catch (Exception $e) {
    Cat::logError('Error', get_class($e), $e);
}

echo "hello, world\n";
sleep(100000);