<?php

namespace spidfire\Elements;
use spidfire\ElementBase;
use spidfire\Utilities\HtmlBuilder;

class Input extends ElementBase{
	var $value = null;
	var $type = "text";

	function setValue($value){
		$this->value =  $value;
	}

	function getValue(){
		$submit = $this->getSubmitValue();
		if($submit != null){
			return $submit;
		}else{
			return $this->value;
		}
	}

	private $labelname = "";
	function label($text){
		$this->labelname = $text;
		return $this;
	}



	function render(){
		$e = new HtmlBuilder('label');
		$e->addText($this->labelname);
		$e->add('input')
		  ->attr('type',$this->type)
		  ->attr('name', $this->getName())
		  ->attr('value', $this->getValue());
		return $e->render();
	}
}