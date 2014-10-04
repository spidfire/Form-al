<?php

namespace spidfire\Elements;
use spidfire\ElementBase;
use spidfire\Utilities\HtmlBuilder;

class Text extends ElementBase{
	var $value = null;
	var $full_width = true;
	var $mark_for_export = false;

	function setValue($value){
	}

	function getValue(){
		return false;
	}

	function isClicked($fail_on_error = true){
		$updateArray = $this->getFormAl()->updatedValues();
		$name = md5($this->getName());
		return isset($updateArray[$name]);
		
	}
	var $text = "You need to set this text with using ->setText()";
	function setText($text){
		$this->text = $text;
	}
	function render(){
		  
		return $this->text;
	}
}