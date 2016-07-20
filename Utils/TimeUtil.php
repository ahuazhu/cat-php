<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/19  下午2:16
 */

namespace Utils;


class TimeUtil
{

    public static function currentTimeInMicro()
    {
        list($usec, $sec) = explode(" ", microtime());

        return (int)($sec * 1000 * 1000 + $usec * 1000 * 1000);
    }

    public static function currentTimeInMillis() {
        list($usec, $sec) = explode(" ", microtime());
        return (int)($sec * 1000 + $usec * 1000);
    }

    public static function currentTimeInSecond() {
        list(, $sec) = explode(" ", microtime());
        return (int) $sec;
    }

    public static function format($timestampInMillis)
    {
        $seconds = $timestampInMillis / 1000;
        $millis = $timestampInMillis % 1000;
        date_default_timezone_set('PRC');
        return date('Y-m-d H:i:s', $seconds). "." . $millis;
    }


}



