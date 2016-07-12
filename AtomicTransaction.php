<?php


class AtomicTransaction
{
	private $type = 'A';
	private $timestamp = '2016-07-12 19:02:26.911'; #当前时间戳，否则server会丢弃
	private $m_type = "TestType";
	private $m_name = "TestName";
	private $status = '0';
	private $duration = '10000us';
	private $data = 'this is the data';


	public function encode() {

		$data =  $this->type 
			. $this->timestamp . "\t"
			. $this->m_type    . "\t"
			. $this->m_name    . "\t"
			. $this->status    . "\t"
			. $this->duration  . "\t"
			. $this->data      . "\t\n";
		echo $data;
		return $data;

#		return "A2016-07-12 18:51:41.987\tTestType\tTestName\t0\t10000us\there is the data.\t\n";
#		A2016-07-12 19:02:26.911	TestType	TestName	0	this is the data
	}

}

$event = new AtomicTransaction();

?>