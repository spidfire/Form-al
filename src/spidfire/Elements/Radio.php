<?php

namespace spidfire\Elements;
use spidfire\Utilities\HtmlBuilder;

class Radio extends Input{
	var $options = array();
	function options($options){
		$this->options = $options;
	}

	function render(){
		$e = new HtmlBuilder('div');
		$sel = $e->add('ul');

		$this->optGroups($sel,$this->options);

		 
		return $e->render();
	}

	function optGroups(HtmlBuilder $p , $data){
		foreach ($data as $key => $value) {
			if(is_array($value)){
				$list = $p->add('li');
				$list->addText($key);
				$sub = $list->add('ul');
				$this->optGroups($sub,$value);
			}else{
				$label = $p
			      ->add('li')
				    ->add('label')
				      ->add('input')
						->attr('type','radio')
						->attr('name', $this->getName())
						->attr('checked', ($key == $this->getValue() ? 'selected' : null) )
						->attr('value', $key)
				      ->addText($value);

			}
		}
	}
	
}