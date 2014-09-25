<?php

namespace spidfire\Validators;
use spidfire\ValidatorBase;
use spidfire\ElementBase;

class MinFileSize extends ValidatorBase {
	var $trans_empty = "Bestand te klein";
	var $trans_empty_text = "Bestand wat ingeleverd is moet minimaal 1 MB zijn";
	function validateInput($data,ElementBase $element){
		if(is_string($data)){
			if(filesize($data) < 1024*1024)
				return true;
			else
				$element->error($this->trans_empty, $this->trans_empty_text);	
		}elseif(is_null($data))
			$element->error($this->trans_empty, $this->trans_empty_text);
		else
			$element->error("Onbekende inhoud", "De inhoud van dit veld is niet correct. (is null)");
		return false;
	}


}