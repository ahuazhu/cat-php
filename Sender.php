<?php

include_once("Header.php");
include_once("AtomicTransaction.php");

$header = new Header();
$transaction = new AtomicTransaction();

$data = $header->encode(). $transaction->encode();

$len = strlen($data);

$len_bin = pack('N', $len);
$data_bin = pack("a{$len}", $data);

$_data = $len_bin . $data_bin;

echo $data;

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);  
$connection = socket_connect($socket, 'ahuazhu.com', 2280);    //连接服务器端socket  
$result = socket_write($socket, $_data, strlen($_data));
?>