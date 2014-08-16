<?php

namespace spidfire;


class FormAl extends FormAlAbstract{	

	function render(){
		$errors = array();
		foreach ($this->getelements() as $el) {
			$el->runValidators();
			$errors = array_merge($errors, $el->getErrors());
		}
		foreach ($errors as $key => $value) {
			echo "<div>".$value['name']. ", has an error: <strong>".$value['title']."</strong><p>".$value['text']."</p></div>";
		}
		$html = "<form>";
		foreach ($this->getelements() as $el) {
			$html .= $el->render()."<Br/>";
		}
		$html .= "</form>";
		return $html;
	}

	var $callables = array(
		"input" => "spidfire\Elements\Input",
		"password" => "spidfire\Elements\Password",
		"submit" => "spidfire\Elements\Submit",
		);


}