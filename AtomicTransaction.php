<?php


class AtomicTransaction
{
	private $type = 'A';
	private $timestamp = '2016-07-13 14:18:26.911'; #当前时间戳，否则server会丢弃
	private $m_type = "TestType";
	private $m_name = "TestName";
	private $status = '0';
	private $duration = '10000us';
	private $data = 'this is the data';


	public function encode() {
/*
		$data =  $this->type 
			. $this->timestamp . "\t"
			. $this->m_type    . "\t"
			. $this->m_name    . "\t"
			. $this->status    . "\t"
			. $this->duration  . "\t"
			. $this->data      . "\t\n";
		return $data;
*/
		return "t2016-07-13 16:05:10.987\tURL\tReview\t\n" . 
		      "E2016-07-13 16:05:10.987\tURL\tPayload\t0\tip=127.0.0.1&ua=Mozilla 5.0…&refer=…&…\t\n" . 
		      "A2016-07-13 16:05:10.987\tService\tAuth\t0\t20000us\tuserId=1357&token=…\t\n" . 
		      "t2016-07-13 16:05:10.009\tCache\tfindReviewByPK\t\n" . 
		      "E2016-07-13 16:05:10.009\tCacheHost\thost-1\t0\tip=192.168.8.123\t\n" .
		      "T2016-07-13 16:05:11.010\tCache\tfindReviewByPK\tMissing\t1000us\t2468\t\n" . 
		      "A2016-07-13 16:05:11.012\tDAL\tfindReviewByPK\t0\t5000us\tselect title,content from Review where id = ?\t\n" . 
		      "E2016-07-13 16:05:11.027\tURL\tView\t0\tview=HTML\t\n" . 
		      "T2016-07-13 16:05:11.087\tURL\tReview\t0\t100000us\t/review/2468\t\n";

#		return "A2016-07-12 18:51:41.987\tTestType\tTestName\t0\t10000us\there is the data.\t\n";
#		A2016-07-12 19:02:26.911	TestType	TestName	0	this is the data
	}

}

$event = new AtomicTransaction();

?>