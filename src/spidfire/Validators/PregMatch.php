***REMOVED***

namespace spidfire\Validators;
use spidfire\ValidatorBase;
use spidfire\ElementBase;

class PregMatch extends ValidatorBase {
	var $regex = '';
	private $results = '';

	function __construct($regex){
		$this->regex = $regex;
	***REMOVED***
	function getResults(){
		return $this->results;
	***REMOVED***

	function validateInput($data,ElementBase $element){
		$this->results = array();
		if(is_string($data)){
			if(preg_match($this->regex, $data, $this->results))
				return true;
			else
				$element->error("Regex did not match the given data", "The regulair expression did not match the given data");		
		***REMOVED***else
			$element->error("Unkown data type", "The type of this value is not a String");
		return false;
	***REMOVED***


***REMOVED***