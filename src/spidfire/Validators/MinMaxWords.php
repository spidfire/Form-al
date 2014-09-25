<?php

namespace spidfire\Validators;
use spidfire\ValidatorBase;
use spidfire\ElementBase;

class MinMaxWords extends ValidatorBase {
	var $min = 0;
	var $max = 10000000;

	function __construct($min, $max){
		$this->min = $min;
		$this->max = $max;
	}
	function validateInput($data,ElementBase $element){
		if(is_string($data)){
			$words = preg_split("/\\s+/", $data);
			if(count($words) >= $this->min && count($words) <= $this->max )
				return true;
			else
				$element->error("Verkeerde hoeveelheid woorden" , "De invoer moet tussen de {$this->min} en {$this->max} aantal woorden, het zijn er momenteel: ".count($words));		
		}else
			$element->error("Onbekende inhoud", "De inhoud is niet correct");
		return false;
	}


}