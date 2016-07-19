<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/18  下午5:25
 */

namespace Message;


interface Transaction extends Message
{
    function addChild($message);

    function getChildren();

    function getDurationInMicros();

    function getDurationInMillis();

    function hasChildren();

    function isStandalone();
}