***REMOVED***

namespace spidfire\Validators;
use spidfire\ValidatorBase;
use spidfire\ElementBase;

class ExactCount extends ValidatorBase {
	var $trans_empty = "Leeg veld";
	var $trans_empty_text = "Dit veld mag niet leeg zijn";
	var $exactCount = null;

	function __construct($count){
		$this->exactCount = $count;
	***REMOVED***
	function validateInput($data,ElementBase $element){
		if(is_array($data)){
			if(count($data) == $this->exactCount)
				return true;
			else
				$element->error("Verkeerde hoeveelheid" , "De invoer moet bestaan uit  exact {$this->exactCount***REMOVED*** elementen");		
		***REMOVED***else
			$element->error("Te weinig inhoud", "De invoer moet bestaan uit  exact {$this->exactCount***REMOVED*** elementen");
		return false;
	***REMOVED***


***REMOVED***