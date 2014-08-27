***REMOVED***

namespace spidfire\Validators;
use spidfire\ValidatorBase;
use spidfire\ElementBase;

class NotNull extends ValidatorBase {

	function validateInput($data,ElementBase $element){
		if(is_string($data)){
			if(!empty($data))
				return true;
			else
				$element->error("The given data is empty", "The given input should not be empty".$this->minlength);		
		***REMOVED***elseif(is_array($data)){
			if(count($data) > 0)
				return true;
			else
				$element->error("The given data is empty", "The given input should not be empty".$this->minlength);		
		***REMOVED***else
			$element->error("Unkown data type", "The type of this value is not a String");
		return false;
	***REMOVED***


***REMOVED***