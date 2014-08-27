***REMOVED***

namespace spidfire\Elements;
use spidfire\Utilities\HtmlBuilder;

class Select extends Input{
	var $options = array();
	function options($options){
		$this->options = $options;
	***REMOVED***

	function render(){
		$e = new HtmlBuilder('select.form-control');
		$e->attr('name', $this->getName());

		$this->optGroups($e,$this->options);

		 
		return $e->render();
	***REMOVED***

	function optGroups(HtmlBuilder $p, $data){
		foreach ($data as $key => $value) {
			if(is_array($value)){
				$sub = $p->add('optgroup')
				 ->attr('label',$key);
				 $this->optGroups($sub,$value);
			***REMOVED***else{
				$p->add('option')
				 ->attr('value',$key)
				 ->attr('selected', ($key == $this->getValue() ? 'selected' : null) )
				 ->addText($value);
			***REMOVED***
		***REMOVED***
	***REMOVED***
	
***REMOVED***