<?php

/**
 * 
 * 
 * @file CatClient.php
 * @author Jxt
 * @creation_date 2016-7-7 13:31:42
 * 
 * 10.10.105.242 2280
 */

$cat = new CatClient('user.smzdm.com');

$url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]; 
list($path, $params) = explode('?', $_SERVER["REQUEST_URI"]);
$cat->transStart('URL', $path, $params);


$cat->transOver();
register_shutdown_function([$cat, 'send_data']);


class CatClient {
    
    public $is_open = false;
    private $_version = 'PT1';
    private $_domain = '';
    private $_hostname = '';
    private $_message_id = null;
    private $_parent_message_id = 'null';
    private $_root_message_id = 'null';
    private $_spacing = "\t";
    private $_depth = 0;
    private $_trans_container = [];
    private $_head = '';
    private $_body = '';
    private $_data = '';
    
    
    function __construct($domain, $message_id = null, $parent_message_id = 'null', $root_message_id = 'null') {
        $this->_domain = $domain;
        $this->_hostname = gethostname();
        if (empty($message_id)) {
            $this->_message_id = $this->_root_message_id = $this->generate_message_id();
            $this->_parent_message_id = '';
        } else {
            $this->_message_id = $message_id;
            $this->_parent_message_id = $parent_message_id;
            $this->_root_message_id = $root_message_id;
        }
    }
    
    function generate_message_id() {
        $time = microtime(true);
        $uniqid = uniqid();
        $rand = rand(10000, 99999);
        return "{$this->_hostname}-{$time}-{$uniqid}{$rand}";
    }
    
    function get_current_time() {
        $time = date('Y-m-d H:i:s');
        $m_time = microtime();
        $m_time = substr($m_time, 2, 3);
        return "{$time},{$m_time}";
    }
    
    function get_micro_time() {
        $t = microtime();
        $t = substr($t, -4) . substr($t, 2, 6);
        return intval($t);
    }
    
    private function _record($action, $type, $name, $other_params = []) {
        $time = $this->get_current_time();

        $elements = [
            "{$action}{$time}",
            $type,
            $name,
        ];
        $elements = array_merge($elements, $other_params);
        if (isset($elements['data']) && !is_scalar($elements['data'])) {
            $elements['data'] = json_encode($elements['data']);
        }
        $elements = implode($this->_spacing, $elements);
        $this->_body .= "{$elements}{$this->_spacing}\n";
    }
    
    #transaction开始
    public function transStart($type, $name, $data = null) {
        $this->_record('t', $type, $name);
        $micro_start = $this->get_micro_time();
        $this->_trans_container[$this->_depth] = [$type, $name, $micro_start, $data];
        $this->_depth++;
    }
    

    #transaction结束
    public function transOver($data = null) {
        $this->_depth--;
        list($type, $name, $micro_start, $start_data) = $this->_trans_container[$this->_depth];
        
        $micro_over = $this->get_micro_time();
        $micro_second = ($micro_over - $micro_start ) . 'us';
        
        $data = is_null($data) ? $start_data : $data;
        $status = '0';
        $this->_record('T', $type, $name, [$status, $micro_second, $data]);
        
        $this->_trans_container[$this->_depth] = null;
    }
    
    #event打点
    public function event($type, $name, $data = '') {
        $this->_record('e', $type, $name, $data);
    }
    
    private function _assem_head() {
        $ip = '127.0.0.1';
        $thread_group_name = 'PHP';
        $process_id = getmygid();
        $session_token = 'null';
        $this->_head = "{$this->_version}\t{$this->_domain}\t{$this->_hostname}\t{$ip}\t{$thread_group_name}\t{$process_id}\t{$this->_message_id}\t{$this->_parent_message_id}\t{$this->_root_message_id}\t{$session_token}\n";
    }
    
    private function _assem_data() {
        $this->_data = $this->_head . $this->_body;
        $len = strlen($this->_data);
        $len_bin = pack('N', $len);
        $data_bin = pack("a{$len}", $this->_data);
        $this->_data = $len_bin . $data_bin;
    }
    
    
    public function send_data() {
        $this->_assem_head();
        $this->_assem_data();
        #echo $this->_data;exit;

        // 建立客户端的socet连接  
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);  
        $connection = socket_connect($socket, '10.10.105.242', 2280);    //连接服务器端socket  

        // 将客户的信息写到通道中，传给服务器端  
        $result = socket_write($socket, $this->_data, strlen($this->_data));
        var_dump($result);
    }
    
    
    
}
