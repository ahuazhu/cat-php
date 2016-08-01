<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/19  下午1:58
 */

namespace Message\Impl;


use Config\Config;
use Utils\NetUtil;
use Utils\ThreadUtil;
use Utils\TimeUtil;

class DefaultMessageIdFactory
{
    private static $domain;

    private static $hexIpAddress;

    public static function getNextId($domain=null)
    {
        self::checkInit();

        $currentHourStamp = self::currentHourStamp();
        $index = self::getIndexProducer($currentHourStamp)->nextIndex();

        $messageId = $domain == null ? self::$domain : $domain;
        $messageId .= "-";
        $messageId .= self::$hexIpAddress . "-";
        $messageId .= $currentHourStamp . "-";


        $threadId = ThreadUtil::getThreadId();

        $index = $threadId << 32 | $index;
        $messageId .= $index;

		return $messageId;

    }

    private static function checkInit()
    {
        if (self::$domain == null) {
            self::$domain = Config::getDomain();
        }

        if (self::$hexIpAddress == null) {
            self::$hexIpAddress = NetUtil::getHexIpAddress();
        }
    }


    private static $indexProducer;

    private static function currentHourStamp()
    {
        return (int) (TimeUtil::currentTimeInSecond() / 3600);
    }

    private static function getIndexProducer($currentHourStamp)
    {
        if (self::$indexProducer == null) {
            self::$indexProducer = new IndexProducer($currentHourStamp);
        }

        if (self::$indexProducer->getVersion() != $currentHourStamp) {
            self::$indexProducer = new IndexProducer($currentHourStamp);
        }

        return self::$indexProducer;
    }

}