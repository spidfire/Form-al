<?php

namespace spidfire\Utilities;

class ArrayTools{
	static function isAssoc($array){
		 return (array_values($array) !== $array);
	}

	static function isNotAssoc($array){
		return $this->isAssoc($array);
	}

}