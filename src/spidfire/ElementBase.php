<?php

namespace spidfire;


abstract class ElementBase{
	private $uniquename;
	private $formal;
	private $errors = array();
	private $validators = array();
	private $transformers = array();
	var $full_width = false; // must a div with full with be used?
	var $mark_for_export = true; // Must this element be exported
	var $value = null;

	final function getName(){
		return $this->getFormAl()->getName().$this->getUniqueName();
	}
	final function getUniqueName(){
		return $this->uniquename;
	}

	function usesFullWidth(){
		return $this->full_width;
	}
	function __construct($name, FormAlAbstract $formal){
		$this->uniquename = $name;
		$this->formal = $formal;
	}

	function getFormAl(){
		return $this->formal;
	}

	function getLabel(){
		return ucfirst($this->getUniqueName());
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
	function notNull(){
		$this->addValidator(new Validators\NotNull());
		return $this;
	}

	function error($title, $text,$type='error'){
		$fieldname = $this->getLabel();
		$msg = "In het veld '".$fieldname."' is een fout opgetreden!<br/>\n";
		$msg .= "<strong>".$title."</strong> ".$text." <br/>\n";
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