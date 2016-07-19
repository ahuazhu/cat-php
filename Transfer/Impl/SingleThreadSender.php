<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/19  下午6:00
 */

namespace Transfer\Impl;


use Codec\PlainTextCodec;
use Transfer\Sender;

class SingleThreadSender implements Sender
{

    private $m_codec;

    public function __construct()
    {
        $this->m_codec = new PlainTextCodec();
    }

    function send($messageTree)
    {
        $data = $this->m_codec->encode($messageTree);

        var_dump($data);
    }
}