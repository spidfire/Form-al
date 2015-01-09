<?php

namespace spidfire\Elements;
use spidfire\Validators\MinLength;
use spidfire\Utilities\HtmlBuilder;

class BinaryCheckboxes extends Input{	
	var $options = array();
	function options($options){
		$this->options = $options;
	}


	function getValue(){
		$submit = $this->getSubmitValue();
		if($submit === null){
			return $this->value;
		}
		$byte = 0;
		foreach ($this->options as $bit => $name) {
			if(isset($submit[$bit])){
				$byte |= 1 << $bit;
			}
		}
		return $byte;
	}

	function render(){
		$checked = null;
		$bc = new HtmlBuilder('div.binarycontainer');

		// this is to allow none of the files to be set
		$bc->add('input')
			  ->attr('type','hidden')
			  ->attr('name', $this->getName()."[-1]")
			  ->attr('value', 'nothing');


		foreach ($this->options as $bit => $text) {
			$checked = (($this->getValue() & (1 << $bit)) > 0) ? "checked" : null;
			$cont = $bc->add('div');
			$cont->add('label')->addHtml($text);
			$cont->add('input')
			  ->attr('type','checkbox')
			  ->attr('name', $this->getName()."[".$bit."]")
			  ->attr('checked', $checked);

		}
		return $bc->render();
	}
}