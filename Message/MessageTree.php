<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/18  下午10:29
 */

namespace Message;


interface MessageTree
{

    public function copy();

    public function getMessage();


    public function getVersion();


    public function getDomain();

    public function getHostName();

    public function getIpAddress();

    public function getSessionToken();

    public function getMessageId();

    public function getParentMessageId();

    public function getRootMessageId();

    public function getThreadGroupName();

    public function getThreadId();

    public function getThreadName();

    public function setDomain($domain);

    public function setHostName($hostName);

    public function setIpAddress($ipAddress);

    public function setMessage($message);

    public function setMessageId($messageId);

    public function setSessionToken($session);

    public function setParentMessageId($parentMessageId);

    public function setRootMessageId($rootMessageId);

    public function setThreadGroupName($name);

    public function setThreadId($threadId);

    public function setThreadName($id);
}