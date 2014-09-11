***REMOVED***

namespace spidfire\Validators;
use spidfire\ValidatorBase;
use spidfire\ElementBase;

class MinLength extends ValidatorBase {
	var $minlength = 0;

	function __construct($length){
		$this->minlength = $length;
	***REMOVED***

	function validateInput($data,ElementBase $element){
		if(is_string($data)){
			if(strlen($data) >= $this->minlength)
				return true;
			else
				$element->error("Veld inhoud te kort", "De lengte van de waardes moet langer zijn dan ".$this->minlength." characters");		
		***REMOVED***else
			$element->error("Onbekende inhoud", "De inhoud van dit veld is niet correct. (min lengte check)");
		return false;
	***REMOVED***


***REMOVED***