<?php

namespace spidfire;


abstract class ElementBase{
	private $uniquename;
	private $errors = array();
	private $validators = array();
	private $transformers = array();

	function getName(){
		return $this->uniquename;
	}
	function __construct($name){
		$this->uniquename = $name;
	}
	function getHumanName(){
		return ucfirst($this->uniquename);
	}

	function addValidator(ValidatorBase $v){
		$this->validators[] = $v;
		return $this;
	}

	abstract function setValue($value);
	abstract function getValue();
	abstract function render();

	function feedArray(){
		return $_GET;
	}
	function getSubmitValue(){
		$feed = $this->feedArray();
		return isset($feed[$this->uniquename]) ? $feed[$this->uniquename] : null;
	}


	function runValidators(){
		$errors = array();
		foreach ($this->validators as $validator) {
			$value = $this->getValue();
			if($validator->validateInput($value,$this)){
				return false;
			}
		}
		return true;
	}

	function error($title, $text){
		$this->errors[] = array("type" => "error","title"=>$title,"text"=>$text,"name" => $this->getHumanName());
	}

	function warning($title, $text){
		$this->errors[] = array("type" => "warning","title"=>$title,"text"=>$text,"name" => $this->getHumanName());
	}

	function getErrors(){
		return $this->errors;
	}

}