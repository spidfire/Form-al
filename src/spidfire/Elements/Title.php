***REMOVED***

namespace spidfire\Elements;
use spidfire\ElementBase;
use spidfire\Utilities\HtmlBuilder;

class Title extends ElementBase{
	var $value = null;
	var $full_width = true;
	var $mark_for_export = false;

	function setValue($value){
	***REMOVED***

	function getValue(){
		return false;
	***REMOVED***

	function isClicked($fail_on_error = true){
		$updateArray = $this->getFormAl()->updatedValues();
		$name = md5($this->getName());
		return isset($updateArray[$name]);
		
	***REMOVED***
	var $text = "You need to set this title with using ->setText()";
	function setText($text){
		$this->text = $text;
	***REMOVED***
	function render(){
		  
		return "<h2>".$this->text."</h2>";
	***REMOVED***
***REMOVED***