<?php

namespace spidfire\Elements;
use spidfire\Validators\MinLength;
use spidfire\ElementBase;
use spidfire\Utilities\HtmlBuilder;

class Colorpicker extends ElementBase{	
	var $type = "text";
	

	private $labelname = "";
	function label($text){
		$this->labelname = $text;
		return $this;
	}

	function getLabel(){
		return $this->labelname;
	}


	function render(){


		$e = new HtmlBuilder('div');
		$e->attr('type',$this->type)
		  ->attr('id', $this->getName())
		  ->attr('value', $this->getValue());

		$e->add('input')
		  ->attr('name', $this->getName())
		  ->attr('type', "text")
		  ->attr('value', $this->getValue())
		  ->attr('class', "form-control")
		  ->attr('style', "display:inline; width: 366px;");

		$e->add('span')
		  ->attr('class', "input-group-addon")
		  ->attr('style', "width:60px;display:inline;padding-bottom:5px;padding-top:8px;padding-left:22px;");

		$e->add('i');
	

		  //->attr('style', 'height: 32px; width: 400px;');
		
		$e->addhtml("<script>$('#".$this->getName()."').colorpicker();</script>");	
		return $e->render();


	}

	function min($length){
		$this->addValidator(new MinLength($length));
		return $this;
	}
}