<?php

$TAB = '\t';
$LF = '\n';


class Event
{
	private $type = 'E';
	private $timestamp = '2016-07-12 14:56:48.911'; #当前时间戳，否则server会丢弃
	private $m_type = "TestType";
	private $m_name = "TestName";
	private $status = '0';
	private $data = 'this is the data';


	public function encode() {
#		return getBytes("E2016-07-12 14:56:48.911\tTestType\tTestName\t0\tthere is the data.\t\n");

#		$data =  $this->type 
#			. $this->timestamp . "\t"
#			. $this->m_type    . "\t"
#			. $this->m_name    . "\t"
#			. $this->status    . "\t"
#			. $this->data      . "\t\n";
#
#		return $data;
		return "A2016-07-12 18:51:41.987\tTestType\tTestName\t0\t10000us\there is the data.\t\n";
	}

}

$event = new Event();

echo $event->encode();

?>