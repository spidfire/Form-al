<?php
namespace spidfire\Utilities;

class Fi18n{
	private $strings = array(
		"" => "",


	);


	static function __(){
		$args = func_get_args();

		if(isset($this->strings[$name])){
			$args[0] = $this->strings[$name];
		}else{
			throw new Exception("Undefined translation: $name", 1);
			
		}


		return call_user_func_array('sprintf', $args);
	}


}