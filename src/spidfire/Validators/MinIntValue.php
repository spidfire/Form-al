<?php

namespace spidfire\Validators;
use spidfire\ValidatorBase;
use spidfire\ElementBase;

class MinIntValue extends ValidatorBase {
	var $minvalue = 0;
	var $errorLowTitle = "Veld waarde te laag";
	var $errorLowText = "De waarde van dit veld moet minimaal %d zijn";
	function __construct($length){
		$this->minvalue = $length;
	}

	function validateInput($data,ElementBase $element){
		if(is_int($data) || ctype_digit($data)){
			$data = (int) $data;
			if($data >= $this->minvalue)
				return true;
			else
				$element->error($this->errorLowTitle, sprintf($this->errorLowText,$this->minvalue));		
		}else
			$element->error("Onbekende inhoud", "De inhoud van dit veld is niet correct. (min lengte check)");
		return false;
	}


}