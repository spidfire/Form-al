***REMOVED***
namespace spidfire\Utilities;

class Fi18n{
	private $strings = array(
		"" => "",


	);


	static function __(){
		$args = func_get_args();

		if(isset($this->strings[$name])){
			$args[0] = $this->strings[$name];
		***REMOVED***else{
			throw new Exception("Undefined translation: $name", 1);
			
		***REMOVED***


		return call_user_func_array('sprintf', $args);
	***REMOVED***


***REMOVED***