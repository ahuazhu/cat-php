<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/19  下午1:48
 */

namespace Message;


interface MessageIdFactory
{
    public function getNextId();

    public function setDomain($domain);

    public function setIpAddress($ipAddress);
}