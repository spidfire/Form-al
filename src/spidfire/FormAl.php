***REMOVED***

namespace spidfire;
use spidfire\Utilities\HtmlBuilder;

class FormAl extends FormAlAbstract{	
	const SHOW_ERRORS = true;
	const HIDE_ERRORS = false;
	var $use_tabs = true;
	var $tab_count = 0;
	var $confirmtext = null;

	function render($show_errors = true){
		$form = HtmlBuilder::create('form')
				->attr('method', 'POST')
				->attr('id', $this->getName())
				->attr('enctype', "multipart/form-data");

		if(!is_null($this->confirmtext))
			$form->attr('onsubmit', 'return window.confirm('.json_encode($this->confirmtext).');');

		if($show_errors)				
			if($this->hasErrors()){
            $form->add('div.alert.alert-danger')
            ->addHtml("<h2>Er zijn ".count($this->getErrors())." fouten opgetreden.</h2>");
		      // foreach ($this->getErrors() as $e) {
		      //         ->addHtml($e['msg'])
		      //         ->render();
		      // ***REMOVED***
		    ***REMOVED***

		foreach ($this->getelements() as $el) {
			if($this->use_tabs == true && $el instanceof Elements\Title){

				if($this->tab_count > 0){
					$form->addHtml("</section>");
				***REMOVED***

				$form->addHtml("<section class='step' data-step-title=\"".htmlentities($el->text)."\">");
				$this->tab_count++;

			***REMOVED***else{
				if($el->usesFullWidth() == true){
					$div = $form->add('div.form-group.row');
					$holder = $div->add('div.col-sm-12');
				***REMOVED***else{
					$div = $form->add('div.form-group.row');
					$label = $div->add('label.col-sm-3.control-label')
				    ->addText($el->getLabel());
					$holder = $div->add('div.col-sm-9');
				***REMOVED***
				
				if($show_errors)	
					foreach ($el->getErrors() as $err) {
						$holder->add('div.alert.alert-danger')
						     ->style('')
						     ->addHtml("<strong>".$err['title']. "</strong> - " . $err['text']);
					***REMOVED***			
				// $form->nl();
				$holder->addHtml($el->render());
			***REMOVED***
		***REMOVED***
		if($this->tab_count > 0){
			$form->addHtml("</section>");
			$form->addHtml("<script>");
			$form->addHtml("$('#".$this->getName()."').easyWizard();"); 
			$form->addHtml("</script>");
		***REMOVED***
		return $form->render();
	***REMOVED***

	function updatedValues(){
		// get update values from GET
        return $_POST;
    ***REMOVED***

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
		"binarycheckboxes" => "spidfire\Elements\BinaryCheckboxes",
		"imageuploadserver" => "spidfire\Elements\ImageUploadToServer",
		"selectsteps" => "spidfire\Elements\SelectSteps",

		"input" => "spidfire\Elements\Input",
		"password" => "spidfire\Elements\Password",
		"select" => "spidfire\Elements\Select",
		"autocompete" => "spidfire\Elements\Autocomplete",
		"submit" => "spidfire\Elements\Submit",
		"text" => "spidfire\Elements\Text",
		"title" => "spidfire\Elements\Title",
		"customFields" => "spidfire\Elements\CustomFields",
		"colorpicker" => "spidfire\Elements\Colorpicker",
        "hidden" => "spidfire\Elements\Hidden",
        "iconupload" => "spidfire\Elements\IconUpload"
***REMOVED***
***REMOVED***