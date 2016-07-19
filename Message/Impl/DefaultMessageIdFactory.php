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

    public function getNextId()
    {
        // TODO: Implement getNextId() method.
    }

    public function setDomain($domain)
    {
        $this->m_domain = $domain;
    }

    public function setIpAddress($ipAddress)
    {
        $this->m_ipAddress = $ipAddress;
    }
}