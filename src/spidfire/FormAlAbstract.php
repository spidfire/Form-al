***REMOVED***

namespace spidfire;


abstract class FormAlAbstract{
	private $uniquename;

	private $elements = array();
	function __construct($name){
		$this->uniquename = $name;
	***REMOVED***

	function addElement(ElementBase $el){
		$this->elements[] = $el;
	***REMOVED***

	function export(){
		$out = array();
		foreach ($this->elements as $el) {
			$name = $el->getName();
			$value = $el->getValue();
			$out[$name] = $value;
		***REMOVED***
		return $out;
	***REMOVED***
	function getElements(){
		return $this->elements;
	***REMOVED***

	abstract function render();


***REMOVED***