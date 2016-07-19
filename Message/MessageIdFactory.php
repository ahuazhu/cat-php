<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/19  下午1:48
 */

namespace Message;


interface MessageIdFactory
{
    function getNextId();

    function setDomain($domain);

    function setIpAddress($ipAddress);
}