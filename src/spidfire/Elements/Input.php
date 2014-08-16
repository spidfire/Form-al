***REMOVED***

namespace spidfire\Elements;
use spidfire\Validators\MinLength;
use spidfire\ElementBase;
use spidfire\Utilities\HtmlBuilder;

class Input extends ElementBase{
	var $value = null;
	var $type = "text";

	function setValue($value){
		$this->value =  $value;
	***REMOVED***

	function getValue(){
		$submit = $this->getSubmitValue();
		if($submit != null){
			return $submit;
		***REMOVED***else{
			return $this->value;
		***REMOVED***
	***REMOVED***

	private $labelname = "";
	function label($text){
		$this->labelname = $text;
		return $this;
	***REMOVED***

	function getHumanName(){
		return $this->labelname;
	***REMOVED***


	function render(){
		$e = new HtmlBuilder('label');
		$e->addText($this->getHumanName());
		$e->add('input')
		  ->attr('type',$this->type)
		  ->attr('name', $this->getName())
		  ->attr('value', $this->getValue());
		return $e->render();
	***REMOVED***

	function min($length){
		$this->addValidator(new MinLength($length));
		return $this;
	***REMOVED***
***REMOVED***