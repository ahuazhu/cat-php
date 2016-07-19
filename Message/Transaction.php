<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/18  下午5:25
 */

namespace Message;


interface Transaction extends Message
{
    public function addChild($message);

    public function getChildren();

    public function getDurationInMicros();

    public function getDurationInMillis();

    public function hasChildren();

    public function isStandalone();
}