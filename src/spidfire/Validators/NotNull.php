<?php

namespace spidfire\Validators;
use spidfire\ValidatorBase;
use spidfire\ElementBase;

class NotNull extends ValidatorBase {
	var $trans_empty = "Leeg veld";
	var $trans_empty_text = "Dit veld mag niet leeg zijn";
	function validateInput($data,ElementBase $element){
		if(is_string($data)){
			if(!empty($data))
				return true;
			else
				$element->error($trans_empty, $trans_empty_text);
		}elseif(is_array($data)){
			if(count($data) > 0)
				return true;
			else
				$element->error($trans_empty, $trans_empty_text);		
		}elseif(is_null($data))
			$element->error($trans_empty, $trans_empty_text);
		else
			$element->error("Onbekende inhoud", "De inhoud van dit veld is niet correct. (is null)");
		return false;
	}


}