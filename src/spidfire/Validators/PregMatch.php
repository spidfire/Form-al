<?php

namespace spidfire\Validators;
use spidfire\ValidatorBase;
use spidfire\ElementBase;

class PregMatch extends ValidatorBase {
	var $regex = '';
	private $results = '';

	function __construct($regex){
		$this->regex = $regex;
	}
	function getResults(){
		return $this->results;
	}
	var $errorTitle = "Fout";
	var $errorText = "De gegeven text voldoet niet aan de regels";

	function setError($title,$error){
		$this->errorTitle = $title;
		$this->errorText = $error;
		return $this;
	}
	function validateInput($data,ElementBase $element){
		$this->results = array();
		if(is_string($data)){
			if(preg_match($this->regex, $data, $this->results))
				return true;
			else
				$element->error($this->errorTitle,$this->errorText);		
		}else
			$element->error("Unkown data type", "The type of this value is not a String");
		return false;
	}


}