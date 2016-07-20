<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/20  上午11:19
 */

namespace Utils;


class NetUtil
{
    private static $ip = null;

    private static $hostName = null;

    public static function getIpAddress() {
        if (self::$ip == null) {
            self::$hostName = getHostName();
            self::$ip = getHostByName(self::$hostName);
        }
        return self::$ip;
    }

    public static function getHostName() {

        if(self::$hostName == null) {
            self::$hostName = getHostName();
        }
        return self::$hostName;
    }

    public static function getHexIpAddress()
    {
        $ip_split = explode('.', self::getIpAddress());
        $hexIp = sprintf('%02x%02x%02x%02x', $ip_split[0], $ip_split[1], $ip_split[2], $ip_split[3]);
        return $hexIp;
    }
}