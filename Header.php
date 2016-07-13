<?php

class Header
{
	private $version = "PT1";
	private $domain = "www";
	private $hostName = "test.hostName";
	private $ipAddress = "127.0.0.1";
	private $threadGroupName = "main-thread-group";
	private $threadId = "main-thread";
	private $threadName = "main-thread";
	private $messageId="www-0a0a69f2-407888-1234";
	private $parentMessageId ="";
	private $rootMessageId="";
	private $sessionToken="";


	public function encode() {


		$header = $this->version;
		$header .= "\t";

		$header .= $this->domain;
		$header .= "\t";

		$header .= $this->hostName;
		$header .= "\t";

		$header .= $this->ipAddress;
		$header .= "\t";

		$header .= $this->threadGroupName;
		$header .= "\t";
		
		$header .= $this->threadId;
		$header .= "\t";

		$header .= $this->threadName;
		$header .= "\t";

		$header .= $this->messageId;
		$header .= "\t";

		$header .= $this->parentMessageId;
		$header .= "\t";
		
		$header .= $this->rootMessageId;
		$header .= "\t";

		$header .= $this->sessionToken;
		$header .= "\t\n";

		return $header;

	}
}


?>