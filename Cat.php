<?php
use Message\Impl\DefaultEvent;

/**
 * Class Cat
 */
class Cat
{

    private static $messageProducer;

    private static function init() {
        self::$messageProducer = new \Message\Impl\DefaultMessageProducer();
        self::$messageProducer->init();
    }

    public static function newTransaction()
    {

    }

    public static function logEvent($type, $name, $data = null)
    {

    }

    public static function logError($type, $name, $error)
    {

    }

    public static function newEvent($type, $name)
    {
        if (self::$messageProducer == null) {
            self::init();
        }

        return self::$messageProducer->newEvent($type, $name);
    }

}