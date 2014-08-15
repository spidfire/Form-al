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


	function addValidator(ValidatorBase $v){
		$this->validators[] = $v;
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

}