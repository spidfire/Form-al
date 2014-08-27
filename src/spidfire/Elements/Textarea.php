<?php

namespace spidfire\Elements;
use spidfire\Utilities\HtmlBuilder;

class Textarea extends Input{
	var $cols= 50;
	var $rows= 7;

	function render(){
		$e = new HtmlBuilder('textarea.form-control');
		  $e->attr('name', $this->getName())
		  ->attr('cols', $this->cols)
		  ->attr('rows', $this->rows)
		  ->addText($this->getValue());
		return $e->render();
	}

}