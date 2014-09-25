***REMOVED***

namespace spidfire\Elements;
use spidfire\Utilities\HtmlBuilder;
use spidfire\Utilities\ArrayTools;

class CustomFields extends Input{
	var $emptyfields = 4;
	var $buttonText= "Voeg een onbekend lid toe";
	var $extra_fields = array();
	function addField($name,$placeholder){
		$this->extra_fields[] = array(
				"name" => $name,
				"placeholder" => $placeholder,
	***REMOVED***
		return $this;
	***REMOVED***
	function setButtonText($text){
		$this->buttonText = $text;
		return $this;
	***REMOVED***
	function render(){
		$e = new HtmlBuilder('div');
		$index = 0;
		$uniquename = 'autocompete_'.md5($this->getName());
		$items = is_array($this->getValue()) ? $this->getValue() : array();
		$holder = $e->add('ul')
			           ->attr('class','autocompleteholder')
			           ->attr('id',$uniquename.'_holder');
		$jsexec = array();	       
		foreach ($items as $key => $value) {
			
				$jsexec[] = $uniquename."add(".json_encode($value).");";
				//$sub->addHtml('<button type="button" onclick=\'$(this).parent( "li" ).remove()\'>X</button>');
		***REMOVED***
		
		
		$e->add('div')->attr('id',''.$uniquename.'_autocompl');
		$e->add('button.btn.btn-primary')
			->attr('type','button')
			->addText($this->buttonText)
			->attr('onclick',''.$uniquename.'add({***REMOVED***)');
		$e->add('noscript')->addText("Sorry this function needs Javascript to work!");
		$e->nl();

		$script = $e->add('script');

		$extra_field_data = "";

		// adds an field to the js
		if(count($this->extra_fields) > 0 ){
			foreach ($this->extra_fields as $field) {
			$extra_field_data .= 'lihtml.append(" "); lihtml.append($("<input/>")
				        .attr({
				          "type": "text",
				          "autocomplete": "off",
				          "name": "'.$this->getName().'["+id_'.$uniquename.'+"]['.$field['name'] .']",
				          "placeholder": "'.$field['placeholder'].'",
				          "value": value["'.$field['name'] .'"] || ""
				        ***REMOVED***));';
			***REMOVED***
		***REMOVED***else{
			$extra_field_data = "You need to add fields";
		***REMOVED***


		$script->addHtml('

				
			
			var  id_'.$uniquename.' = 0;
			function '.$uniquename.'add(value){
				var lihtml = $("<li/>")
				  
					// lihtml.append(name)
					'.$extra_field_data.'

					var button = "<a href=\"Javascript:void(0)\" onclick=\'$(this).parent().remove()\' > X</a>";
	
					lihtml.append(button)
					
			

				lihtml = "<li>"+ lihtml.html() + "</li>";
				$("#'.$uniquename.'_holder").html($("#'.$uniquename.'_holder").html() + lihtml)

				id_'.$uniquename.'++;
			***REMOVED***

			$(function (){
				'.implode("\n", $jsexec).'

			***REMOVED***)
			');
	
		if(json_last_error() != JSON_ERROR_NONE)
			throw new \Exception("JSON ERROR: ".json_last_error_msg(), 1);
			

		return $e->render();
	***REMOVED***

	function utf8_encode_all($dat) // -- It returns $dat encoded to UTF8 
		{ 
		  if (is_string($dat)) return utf8_encode($dat); 
		  if (!is_array($dat)) return $dat; 
		  $ret = array(); 
		  foreach($dat as $i=>$d) $ret[$i] = $this->utf8_encode_all($d); 
		  return $ret; 
		***REMOVED*** 
	
***REMOVED***