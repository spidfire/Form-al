<?php

namespace spidfire;


abstract class ValidatorBase{

	abstract function validateInput($data,ElementBase $el);

	
}