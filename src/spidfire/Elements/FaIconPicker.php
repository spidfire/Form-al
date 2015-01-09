***REMOVED***

namespace spidfire\Elements;
use spidfire\Validators\MinLength;
use spidfire\ElementBase;
use spidfire\Utilities\HtmlBuilder;

class FaIconPicker extends ElementBase{	
	var $type = "text";
	

	private $labelname = "";
	function label($text){
		$this->labelname = $text;
		return $this;
	***REMOVED***

	function getLabel(){
		return $this->labelname;
	***REMOVED***


	function render(){


		$e = new HtmlBuilder('div');
		$e->attr('type',$this->type)
		  ->attr('id', $this->getName())
		  ->attr('value', $this->getValue())
		  ->attr('class', "input-group iconpicker-container");

		if (!empty($this->getValue())) {
			$e->add('input')
			  ->attr('name', $this->getName())
			  ->attr('type', "text")
			  ->attr('value', $this->getValue())
			  ->attr('class', "form-control icp icp-auto")
			  ->attr('style', "display:inline-block; width: 366px;")
			  ->attr('data-placement', "bottomRight");
		***REMOVED*** else {
			$e->add('input')
			  ->attr('name', $this->getName())
			  ->attr('type', "text")
			  ->attr('value', 'fa-android')
			  ->attr('class', "form-control icp icp-auto")
			  ->attr('style', "display:inline-block; width: 366px;")
			  ->attr('data-placement', "bottomRight");
		***REMOVED***

		$e->add('span')
		  ->attr('class', "input-group-addon")
		  ->attr('style', "width: 34px; display: inline-block; padding-bottom: 10px; padding-top: 8px; padding-left: 6px;");

		$e->add('i');
	

		  //->attr('style', 'height: 32px; width: 400px;');
		
		$e->addhtml("<script>$('.icp-auto').iconpicker();</script>");	
		return $e->render();


	***REMOVED***

	function min($length){
		$this->addValidator(new MinLength($length));
		return $this;
	***REMOVED***
***REMOVED***