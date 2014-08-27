***REMOVED***

namespace spidfire\Elements;
use spidfire\ElementBase;
use spidfire\Utilities\HtmlBuilder;

class Submit extends ElementBase{
	var $value = null;

	function setValue($value){
	***REMOVED***

	function getValue(){
		return md5($this->getName());
	***REMOVED***

	function isClicked($fail_on_error = true){
		$updateArray = $this->getFormAl()->updatedValues();
		$name = md5($this->getName());
		return isset($updateArray[$name]);
		
	***REMOVED***

	function render(){
		$e = new HtmlBuilder('input.form-control');
		  $e->attr('type', 'submit')
		  ->attr('name',  md5($this->getName()))
		  ->attr('value', $this->getLabel());
		return $e->render();
	***REMOVED***
***REMOVED***