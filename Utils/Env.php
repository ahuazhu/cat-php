<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/18  下午10:27
 */

namespace Utils;


class Env
{
    public static function isThreadSupport() {
        return false;
    }

    public static function isLinux() {
        return strcmp(PHP_OS, 'Linux') == 0;
    }
}