<?php

namespace spidfire\Elements;
use spidfire\ElementBase;
use spidfire\Utilities\HtmlBuilder;

class Submit extends ElementBase{
	var $value = null;

	function setValue($value){
	}

	function getValue(){
		return md5($this->getName());
	}

	function isSubmitted(){
		$feed = $this->feedArray();
		$name = md5($this->getName());
		return isset($feed[$name]);
	}

	function render(){
		$e = new HtmlBuilder('label');
		$e->add('input')
		  ->attr('type', 'submit')
		  ->attr('name',  md5($this->getName()))
		  ->attr('value', $this->getName());
		return $e->render();
	}
}