<?php

namespace Girafa\Mail\Message;

use Zend\Mail\Message;
use Zend\Mail\Header\GenericHeader;

class Mailgun extends Message
{

	public function setSkipVerification($value) {
		return $this->addCustomHeader('Skip-Verification', $value ? 'True' : 'False');
	}

	public function addTag($tag) {
		return $this->addCustomHeader('Tag', $tag);
	}

	public function setCustomVars($vars) {
		$vars = (array) $vars;
		return $this->addCustomHeader('Variables', json_encode($vars));
	}

	public function addCustomHeader($name, $value) {
		$this->headers->addHeader(new GenericHeader('X-Mailgun-' . $name, $value));
		return $this;
	}

}