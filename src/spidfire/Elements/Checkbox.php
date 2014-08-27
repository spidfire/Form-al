<?php

namespace spidfire\Elements;
use spidfire\Validators\MinLength;
use spidfire\Utilities\HtmlBuilder;

class Checkbox extends Input{	
	var $trueValue = '1';
	var $falseValue = '0';

	function getValue(){
		$submit = $this->getSubmitValue();
		if($submit != null){
			return empty($submit) ? $this->falseValue : $this->trueValue;
		}else{
			if( $this->value  != $this->trueValue)
				return $this->falseValue;
			else
				return $this->trueValue;
		}
	}

	function render(){
		$e = new HtmlBuilder('input');
		$checked = null;

		if($this->getValue() == $this->trueValue)
			$checked = 'checked';

		$e->attr('type','checkbox')
		  ->attr('name', $this->getName())
		  ->attr('checked', $checked)
		  ->attr('value', $this->trueValue);
		return $e->render();
	}
}