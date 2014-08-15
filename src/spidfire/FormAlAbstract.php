<?php

namespace spidfire;


abstract class FormAlAbstract{
	private $uniquename;

	private $elements = array();
	function __construct($name){
		$this->uniquename = $name;
	}

	function addElement(ElementBase $el){
		$this->elements[] = $el;
	}

	function export(){
		$out = array();
		foreach ($this->elements as $el) {
			$name = $el->getName();
			$value = $el->getValue();
			$out[$name] = $value;
		}
		return $out;
	}
	function getElements(){
		return $this->elements;
	}

	abstract function render();


}