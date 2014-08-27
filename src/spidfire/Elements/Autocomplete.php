***REMOVED***

namespace spidfire\Elements;
use spidfire\Utilities\HtmlBuilder;
use spidfire\Utilities\ArrayTools;

class Autocomplete extends Input{
	var $options = array();
	var $emptyfields = 4;
	function options($options){
		$this->options = $options;
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
			
				$jsexec[] = $uniquename."add(".json_encode($this->options[$value]).",".json_encode($value).");";
				//$sub->addHtml('<button type="button" onclick=\'$(this).parent( "li" ).remove()\'>X</button>');
		***REMOVED***
		
		$e->add('input.form-control')
		  ->attr('id',$uniquename."_id")
		  ->attr('class','searchbox')
		  ->attr('type',$this->type)
		  ->attr('autocomplete','off')
		  ->attr('onkeyup',$uniquename."(this.value)")  ;	
		$e->add('div')->attr('id',''.$uniquename.'_autocompl');
		$e->nl();

		$script = $e->add('script');
		$script->addHtml('

				var '.$uniquename.'_items = '.json_encode($this->options).';
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
						var item = $("<li/>");
						item.append(
							$("<button/>")
							.text("Add")
							.attr("type","button")
							.attr("title",v)
							.attr("val",i)
							.click(function (){
								
								'.$uniquename.'add($(this).attr("title"),$(this).attr("val"))
								elm.html("")
								$("#'.$uniquename.'_id").val("")

							***REMOVED***)
						)
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

			function '.$uniquename.'add(name,value){
				var lihtml = $("<li/>")
				  lihtml.append(
				     $("<input/>")
				        .attr({
				          "type": "hidden",
				          "name": "'.$this->getName().'[]",
				          "value": value
				        ***REMOVED***)
					 )
					lihtml.append(name)

					var button = "<a href=\"Javascript:void(0)\" onclick=\'$(this).parent().remove()\' > X</a>";
	
					lihtml.append(button)
					
			

				lihtml = "<li>"+ lihtml.html() + "</li>";
				$("#'.$uniquename.'_holder").html($("#'.$uniquename.'_holder").html() + lihtml)


			***REMOVED***

			$(function (){
				'.implode("\n", $jsexec).'

			***REMOVED***)
			');
	
		if(json_last_error() != JSON_ERROR_NONE)
			throw new Exception("JSON ERROR: ".json_last_error_msg(), 1);
			

		return $e->render();
	***REMOVED***
	
***REMOVED***