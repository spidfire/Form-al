<?php

namespace spidfire\Elements;
use spidfire\Validators\MinLength;
use spidfire\Utilities\HtmlBuilder;

class Checkbox extends Input{	
	var $trueValue = '1';
	var $falseValue = '0';

	function getValue(){
		$submit = $this->getSubmitValue();
		$update = $this->getFormAl()->updatedValues();
		$is_submitted = array_key_exists($this->getName()."_submitted", $update);

		if(is_null($submit)){
			if($is_submitted == true)
				return $this->falseValue;
			else
				return $this->value;				
		}else{
			if(strcasecmp((string)$submit,(string)$this->trueValue) == 0)
				return $this->trueValue;
			else
				return $this->falseValue;
		}
	}

	function render(){
		$checked = null;

		if($this->getValue() == $this->trueValue)
			$checked = 'checked';

		$e = new HtmlBuilder('input');
		$e->attr('type','checkbox')
		  ->attr('name', $this->getName())
		  ->attr('checked', $checked)
		  ->attr('value', $this->trueValue);

		// hidden for submission check
		$h = new HtmlBuilder('input');
		$h->attr('type','hidden')
		  ->attr('name', $this->getName()."_submitted")
		  ->attr('value', 'yes');
		return $e->render().$h->render();
	}
}