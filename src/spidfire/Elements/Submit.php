<?php

namespace spidfire\Elements;
use spidfire\ElementBase;
use spidfire\Utilities\HtmlBuilder;

class Submit extends ElementBase{
	var $value = null;
	var $full_width = true;
	var $mark_for_export = false;

	function setValue($value){
	}

	function getValue(){
		return md5($this->getName());
	}

	function isClicked($fail_on_error = true){
		$updateArray = $this->getFormAl()->updatedValues();
		$name = md5($this->getName());
		return isset($updateArray[$name]);
		
	}

	function render(){
		$e = new HtmlBuilder('input.form-control.btn.btn-primary');
		  $e->attr('type', 'submit')
		  ->attr('name',  md5($this->getName()))
		  ->attr('value', $this->getLabel());
		return $e->render();
	}
}