<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/20  下午2:37
 */

namespace Message\Impl;


use Utils\TimeUtil;

class IndexProducer
{
    private $m_currentIndex;
    private $m_version;

    public function __construct($version)
    {
        $this->m_currentIndex = TimeUtil::currentTimeInSecond() & 0x00fff;
        $this->m_version = $version;

    }

    public function getVersion()
    {
        return $this->m_version;
    }

    public function nextIndex()
    {
        return $this->m_currentIndex ++;
    }
}