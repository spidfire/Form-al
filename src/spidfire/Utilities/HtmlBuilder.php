<?php

namespace spidfire\Utilities;

class HtmlBuilder{
	private $name = '';
	private $attr = array();
	private $add = array();

	function __construct($name){
		$this->name = htmlspecialchars($name);
	}

	function attr($name,$value){
		if($value !== null)
			$this->attr[$name] = $value;
		return $this;
	}

	function add($name){
		$el = new HtmlBuilder($name);;

		$this->add[] = $el;
		return $el;
	}
	function addText($text){
		$this->add[] = $text;
		return $this;
	}

	function render(){
		$html = "<".$this->name;
		
		foreach ($this->attr as $key => $value) {
			if(is_string($value)){
				$html .= " ".$key."=\"".htmlentities($value)."\"";				
			}
		}

		if(count($this->add) > 0){
			$html .= "/>";
			foreach ($this->add as $el) {
				if($el instanceof HtmlBuilder){
					$html .= $el->render()."\n";					
				}else{
					$html .= htmlspecialchars($el);
				}
			}
			
			$html .= "</".$this->name.">";
		}else{
			$html .= "/>";
		}
		return $html;
	}



}