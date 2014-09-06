<?php

namespace spidfire;


abstract class ElementBase{
	private $uniquename;
	private $formal;
	private $errors = array();
	private $validators = array();
	private $transformers = array();
	var $value = null;

	final function getName(){
		return $this->getFormAl()->getName().$this->getUniquenName();
	}
	final function getUniquenName(){
		return $this->uniquename;
	}
	function __construct($name, FormAlAbstract $formal){
		$this->uniquename = $name;
		$this->formal = $formal;
	}

	function getFormAl(){
		return $this->formal;
	}

	function getLabel(){
		return ucfirst($this->getUniquenName());
	}

	function addValidator(ValidatorBase $v){
		$this->validators[] = $v;
		return $this;
	}

	abstract function render();

	function setValue($value){
		$this->value =  $value;
		return $this;
	}
	function defaultValue($value){
		if(is_null($this->value)){
			$this->value = $value;
		}
		return $this;
	}

	function getValue(){
		$submit = $this->getSubmitValue();
		if($submit != null)
			return $submit;
		else
			return $this->value;
		
	}
	function getSubmitValue(){
		$update = $this->getFormAl()->updatedValues();

		return isset($update[$this->getName()]) ? $update[$this->getName()] : null;
	}


	private function runValidators(){
		$this->errors = array();
		foreach ($this->validators as $validator) {
			$value = $this->getValue();
			if($validator->validateInput($value,$this) == false){
				return false;
			}
		}
		return true;
	}

	function error($title, $text,$type='error'){
		$fieldname = $this->getLabel();
		$msg = "Field: '".$fieldname."' has an ".$type.": ".$title." <br/>\n";
		$msg .= "Info: ".$text." <br/>\n";
		$this->errors[] = array(
			"type" => $type,
			"title"=>$title,
			"text"=>$text,
			"name" => $fieldname, 
			"msg"=> $msg
		);
	}

	function warning($title, $text){
		return $this->error($title,$text,'warning');
	}

	function getErrors(){
		if(!$this->runValidators()){
			return $this->errors;			
		}
		return array();
	}


}