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

    public static function newTransaction($type, $name)
    {
        if (self::$messageProducer == null) {
            self::init();
        }
        return self::$messageProducer->newTransaction($type, $name);
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

    public static function logMetricForCount($type, $name='C', $quantity = 1)
    {
        self::logMetricInternal($type, $name, '' . $quantity);
    }

    public static function logMetricForDuration($name, $durationInMillis)
    {
        //TODO implement logMetricForDuration
    }


    public static function logMetricForSum($name, $value)
    {
        //TODO implement logMetricForSum
    }


    private static function logMetricInternal($type, $name, $keyValuePairs)
    {
        if (self::$messageProducer == null) {
            self::init();
        }

        $metric = self::$messageProducer->newMetric($type, $name, $keyValuePairs);

        if (isset($keyValuePairs)) {
            $metric->addData($keyValuePairs);
        }

        $metric->setStatus($name);
        $metric->complete();
    }


    public static function newEvent($type, $name)
    {
        if (self::$messageProducer == null) {
            self::init();
        }

        return self::$messageProducer->newEvent($type, $name);
    }


}