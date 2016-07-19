<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/19  下午1:58
 */

namespace Message\Impl;


use Message\MessageIdFactory;

class DefaultMessageIdFactory implements MessageIdFactory
{
    private $m_domain;

    private $m_ipAddress;

    function getNextId()
    {
        // TODO: Implement getNextId() method.
    }

    function setDomain($domain)
    {
        $this->m_domain = $domain;
    }

    function setIpAddress($ipAddress)
    {
        $this->m_ipAddress = $ipAddress;
    }
}