<?php
use Message\Impl\DefaultMessageProducer;

/**
 * Class Cat
 */
class Cat
{

    private static $messageProducer;

    private static function init()
    {
        self::$messageProducer = new DefaultMessageProducer();
        self::$messageProducer->init();
    }

    public static function newTransaction()
    {

    }

    public static function logEvent($type, $name, $key = null, $value = null, $status = \Message\Message::SUCCESS)
    {
        $event = self::newEvent($type, $name);
        $event->setStatus($status);
        $event->addData($key, $value);
        $event->complete();
    }

    public static function logError($type, $name, Exception $error)
    {
        $event = self::newEvent($type, $name);
        $event->setStatus($error->getMessage());

        $trace = "\n" . $error->getMessage() . "\n";
        $trace .= $error->getTraceAsString() . "\n";

        $event->addData('Trace', $trace);

        $event->complete();
    }

    public static function logMetricForCount($name, $quantity = 1)
    {
        //TODO implement logMetricForCount
    }

    public static function logMetricForDuration($name, $durationInMillis)
    {
        //TODO implement logMetricForDuration
    }


    public static function logMetricForSum($name, $value)
    {
        //TODO implement logMetricForSum
    }




    public static function newEvent($type, $name)
    {
        if (self::$messageProducer == null) {
            self::init();
        }

        return self::$messageProducer->newEvent($type, $name);
    }


}