<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/18  下午5:29
 */

namespace Codec;


interface MessageCodec
{
    public function encode($message);
}