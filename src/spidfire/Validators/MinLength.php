<?php

namespace spidfire\Validators;
use spidfire\ValidatorBase;
use spidfire\ElementBase;

class MinLength extends ValidatorBase {
	var $minlength = 0;

	function __construct($length){
		$this->minlength = $length;
	}

	function validateInput($data,ElementBase $element){
		if(is_string($data)){
			if(strlen($data) >= $this->minlength)
				return true;
			else
				$element->error("Length too short", "The length of this string should be equal or longer than ".$this->minlength);		
		}else
			$element->error("Unkown data type", "The type of this value is not a String");
		return false;
	}


}