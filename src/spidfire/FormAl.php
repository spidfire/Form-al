<?php

namespace spidfire;
use spidfire\Utilities\HtmlBuilder;

class FormAl extends FormAlAbstract{	
	const SHOW_ERRORS = true;
	const HIDE_ERRORS = false;
	function render($show_errors = true){
		$form = HtmlBuilder::create('form')
				->attr('method', 'POST');
		if($show_errors)				
			if($this->hasErrors()){
		      foreach ($this->getErrors() as $e) {
		            $form->add('div')
		              ->attr("style","background-color:red;")
		              ->addHtml($e['msg'])
		              ->render();
		      }
		    }

		foreach ($this->getelements() as $el) {
			$div = $form->add('div.form-group');
			$label = $div->add('label')
			    ->addText($el->getLabel());
			$label->addHtml($el->render());
			if($show_errors)	
				foreach ($el->getErrors() as $err) {
					$form->add('div.alert.alert-danger')
					     ->style('color:red;font-weight:bold;')
					     ->attr('title', wordwrap($err['title']. "\n" . $err['text'],75))
					     ->addText("!");
				}			
			$form->nl();
		}
		
		return $form->render();
	}

	function updatedValues(){
		// get update values from GET
        return $_POST;
    }

	var $callables = array(
		"checkbox" => "spidfire\Elements\Checkbox",
		"radio" => "spidfire\Elements\Radio",
		"textarea" => "spidfire\Elements\Textarea",
		"multiselect" => "spidfire\Elements\MultiSelect",
		"imageupload" => "spidfire\Elements\ImageUpload",
		"fileupload" => "spidfire\Elements\FileUpload",
		"wysiwyg" => "spidfire\Elements\Wysiwyg",
		"table" => "spidfire\Elements\Table",
		"jsoneditor" => "spidfire\Elements\JsonEditor",
		"range" => "spidfire\Elements\Range",
		"datepicker" => "spidfire\Elements\Datepicker",



		"input" => "spidfire\Elements\Input",
		"password" => "spidfire\Elements\Password",
		"select" => "spidfire\Elements\Select",
		"autocompete" => "spidfire\Elements\Autocomplete",
		"submit" => "spidfire\Elements\Submit",
		);


}