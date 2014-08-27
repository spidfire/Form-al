<?php

namespace spidfire\Elements;
use spidfire\ElementBase;
use spidfire\Utilities\HtmlBuilder;

class Password extends Input{
	var $type = "password";

	function setValue($value){
		$this->value =  $value;
	}

	function getValue(){
		$submit = $this->getSubmitValue();
		if($submit != null){
			return $this->encode($submit);
		}else{
			return $this->value;
		}
	}
	private $encodeType = 'plain';
	private $encode_pre_salt = '';
	private $encode_post_salt = '';
	private function encode($data){
		$str = $this->encode_pre_salt .  $data . $this->encode_post_salt ;
		switch ($this->encodeType) {
			case 'md5':
				return md5($this->encode_pre_salt .  $data . $this->encode_post_salt );
				break;
			case 'sha1':
				return sha1($this->encode_pre_salt .  $data . $this->encode_post_salt );
				break;
			
			case 'plain':
				return $data;
				break;

		}
		throw new Exception("No valid encryption method has been chosen", 1);
		
	}

	public function setEncryption($method='plain',$pre_salt='',$post_salt=''){
		$this->encodeType = $method;
		$this->encode_pre_salt = $pre_salt;
		$this->encode_post_salt = $post_salt;
	}


}