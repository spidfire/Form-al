<?php

namespace spidfire;


class FormAl extends FormAlAbstract{	

	function render(){
		$html = "<form>";
		foreach ($this->getelements() as $el) {
			$html .= $el->render()."<Br/>";
		}
		$html .= "</form>";
		return $html;
	}

	var $elements = array(
		"input" => "spidfire\Elements\Input",
		"submit" => "spidfire\Elements\Submit",
		);

	function __call($name,$args){
		if(isset($this->elements[$name])){
			$elment = $this->elements[$name];
			switch(count($args)){
				case 0:$el = new $elment();break;
				case 1:$el = new $elment($args[0]);break;
				case 2:$el = new $elment($args[0],$args[1]);break;
				case 3:$el = new $elment($args[0],$args[1],$args[2]);break;
				default:die("tooo many arguments");
			}
			
			$this->addElement($el);
			return $el;
		}
		var_dump($name,$args);

	}

}