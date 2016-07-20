<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/19  下午1:47
 */

namespace Utils;


class ThreadUtil
{


    public static function getThreadGroupName()
    {
        if (Env::isThreadSupport()) {

        } else {
            return SingleThreadUtil::getThreadGroupName();
        }
    }

    public static function getThreadId()
    {
        if (Env::isThreadSupport()) {

        } else {
            return SingleThreadUtil::getThreadId();
        }
    }

    public static function getThreadName()
    {
        if (Env::isThreadSupport()) {

        } else {
            return SingleThreadUtil::getThreadName();
        }
    }
}

class SingleThreadUtil
{
    public static function getThreadGroupName()
    {
        return 'PHP';
    }

    public static function getThreadId()
    {
        return strval(getmypid());
    }

    public static function getThreadName()
    {
        return 'PHP';
    }
}


class MultiThreadUtil
{
    public static function getThreadGroupName()
    {
    }

    public static function getThreadId()
    {
        return \Thread::getCurrentThreadId();
    }

    public static function getThreadName()
    {
    }
}