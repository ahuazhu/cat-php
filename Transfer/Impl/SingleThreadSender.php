<?php
/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/19  下午6:00
 */

namespace Transfer\Impl;


use Codec\PlainTextCodec;
use Config\Config;
use Transfer\Sender;

class SingleThreadSender implements Sender
{

    private $m_codec;

    private $ROUTER_URL_TEMP = 'http://%s:%d/cat/s/router?domain=%s&ip=%s&op=json';


    public function __construct()
    {
        $this->m_codec = new PlainTextCodec();
    }

    function send($messageTree)
    {
        //TODO: performance consider, should keep the connection.
        $data = $this->m_codec->encode($messageTree);
        $len = strlen($data);

        $len_bin = pack('N', $len);
        $data_bin = pack("a{$len}", $data);

        $_data = $len_bin . $data_bin;

        list($ip, $port) = $this->fetchRouter($messageTree->getDomain(), $messageTree->getIpAddress());

        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_connect($socket, $ip, $port);
        $result = socket_write($socket, $_data, strlen($_data));

        echo $_data;
        echo $result;
    }




    //TODO cache the router for performance consider.
    private function fetchRouter($domain, $ipAddress)
    {

        list($ip,) = Config::getServers()[0];

        $url = sprintf($this->ROUTER_URL_TEMP, $ip, 8080, $domain, $ipAddress);
        $content = file_get_contents($url);

        $json = json_decode($content, true);

        $serversConfig = $json['kvs']['routers'];

        preg_split('/;/', $serversConfig);

        return preg_split("/:/", preg_split("/;/", $serversConfig)[0]);

    }


}