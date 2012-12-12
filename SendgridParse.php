<?php

Class SendgridParse {
	
	private function parseEmailAddress($raw) {
		$name = "";
		$email = trim($raw, " '\"");
		if (preg_match("/^(.*)<(.*)>.*$/", $raw, $matches)) {
			array_shift($matches);
			$name = trim($matches[0], " '\"");
			$email = trim($matches[1], " '\"");
		}
		return array(
			"name" => $name,
			"email" => $email,
			"full" => $name . " <" . $email . ">"
		); 
	}
	
	private function parseEmailAddresses($raw) {
		$arr = array();
		foreach(explode(",", $raw) as $email)
			$arr[] = $this->parseEmailAddress($email);
		return $arr;
	} 
	
	function __construct($post = NULL, $files = NULL) {
		if (!@$post)
			$post = $_POST;
		if (!@$files)
			$files = $_FILES;		
		$this->post = $post;
		$this->files = $files;
		
		$this->headers = @$post["headers"];
		$this->text = @$post["text"];
		$this->html = @$post["html"];
		$this->fromRaw = @$post["from"];
		$this->from = $this->parseEmailAddress(@$this->fromRaw);
		$this->toRaw = @$post["to"];
		$this->to = $this->parseEmailAddresses(@$this->toRaw);
		$this->ccRaw = @$post["cc"];
		$this->cc = $this->parseEmailAddresses(@$this->ccRaw);
		$this->subject = @$post["subject"];
		$this->dkimRaw = @$post["dkim"];
		$this->dkim = json_decode(@$this->dkimRaw);
		$this->spfRaw = @$post["SPF"];
		$this->spf = json_decode(@$this->spfRaw);
		$this->charsetsRaw = @$post["charsets"];
		$this->charsets = json_decode(@$this->charsetsRaw);
		$this->envelopeRaw = @$post["envelope"];
		$this->envelope = json_decode(@$this->envelopeRaw);
		$this->spam_score = @$post["spam_score"];
		$this->spam_report = @$post["spam_report"];
		
		$this->attachments = array();
		foreach ($files as $key=>$value)
			$this->attachments[] = $value;
	}
	
}

?>
