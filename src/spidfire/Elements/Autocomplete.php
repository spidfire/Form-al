***REMOVED***

namespace spidfire\Elements;
use spidfire\Utilities\HtmlBuilder;
use spidfire\Utilities\ArrayTools;

class Autocomplete extends Input{
	var $options = array();
	var $emptyfields = 4;
	var $placeholder = "Zoek";
	var $addButtonText = "Toevoegen";

	function options($options){
		$this->options = $options;
		return $this;
	***REMOVED***
	function setPlaceholder($placeholder){
		$this->placeholder = $placeholder;
		return $this;
	***REMOVED***
	var $extra_fields = array();
	function addField($name,$placeholder){
		$this->extra_fields[] = array(
				"name" => $name,
				"placeholder" => $placeholder,
	***REMOVED***
		return $this;
	***REMOVED***
	function render(){
		$e = new HtmlBuilder('div');
		$index = 0;
		$uniquename = 'autocompete_'.md5($this->getName());
		$items = is_array($this->getValue()) ? $this->getValue() : array();
		$holder = $e->add('ol')
			           ->attr('class','autocompleteholder')
			           ->attr('id',$uniquename.'_holder');
		$jsexec = array();	       
		foreach ($items as $key => $value) {
				$name = json_encode($this->options[$value['name']]);
				if($name == false)
					$name = '"Onbekende naam: '.$value['name'].'"';
				$jsexec[] = $uniquename."add(".$name.",".json_encode($value).");";
				//$sub->addHtml('<button type="button" onclick=\'$(this).parent( "li" ).remove()\'>X</button>');
		***REMOVED***
		
		$e->add('input.form-control.searchbox')
		  ->attr('id',$uniquename."_id")
		  ->attr('type',$this->type)
		  ->attr('placeholder',$this->placeholder)
		  ->attr('autocomplete','off')
		  ->attr('onkeyup',$uniquename."(this.value)")  ;	
		$e->add('div')->attr('id',''.$uniquename.'_autocompl');
		$e->add('noscript')->addText("Sorry this function needs Javascript to work!");
		$e->nl();

		$script = $e->add('script');

		$extra_field_data = "";

		// adds an field to the js
		if($this->extra_fields ){
			foreach ($this->extra_fields as $field) {
			$extra_field_data .= 'lihtml.append(" "); lihtml.append($("<input/>")
				        .attr({
				          "type": "text",
				          "name": "'.$this->getName().'["+id_'.$uniquename.'+"]['.$field['name'] .']",
				          "placeholder": "'.$field['placeholder'].'",
				          "value": value["'.$field['name'] .'"]
				        ***REMOVED***));';
			***REMOVED***
		***REMOVED***


		$script->addHtml('

				var '.$uniquename.'_items = '.json_encode($this->utf8_encode_all($this->options)).';
			function '.$uniquename.'(search,index){
				var count = 0;
				var searchparts = search.toLowerCase().split(" ")
				var elm = jQuery("#'.$uniquename.'_autocompl")
				elm.html("")
				if(search.trim().length == 0)
					return;
				
				for(var i in '.$uniquename.'_items){
					var v= '.$uniquename.'_items[i];
					var partnotfound = true;
					for(var p in searchparts){
						if(v.toLowerCase().indexOf(searchparts[p]) < 0){
							partnotfound = false
						***REMOVED***
					***REMOVED***
					if(partnotfound == true){
						var item = $("<li/>")
							.css("list-style","none");
						item.addClass("autoadd");
						item.append(
							$("<button/>")
							.text("'.$this->addButtonText.'")
							.addClass("btn")
							.addClass("btn-primary")
							.attr("type","button")
							.attr("title",v)
							.attr("val",i)
							.click(function (){
								
								'.$uniquename.'add($(this).attr("title"),{name:$(this).attr("val")***REMOVED***)
								elm.html("")
								$("#'.$uniquename.'_id").val("")

							***REMOVED***)
						)
						item.append("&nbsp;&nbsp;")
						item.append(v)
						elm.append(item)
						count++;
					***REMOVED***

					if(count > 10)
						break;
				***REMOVED***
				if(count == 0)
					elm.append("Geen resultaten")
			***REMOVED***
			var  id_'.$uniquename.' = 0;
			function '.$uniquename.'add(name,value){
				var lihtml = $("<li/>")
				  lihtml.append(
				     $("<input/>")
				        .attr({
				          "type": "hidden",
				          "name": "'.$this->getName().'["+id_'.$uniquename.'+"][name]",
				          "value": value["name"]
				        ***REMOVED***)
					 )
					lihtml.append("<span class=\'autocompletetextholder\'>"+name+"</span>")
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