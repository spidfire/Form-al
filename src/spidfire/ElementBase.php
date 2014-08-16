***REMOVED***

namespace spidfire;


abstract class ElementBase{
	private $uniquename;
	private $errors = array();
	private $validators = array();
	private $transformers = array();

	function getName(){
		return $this->uniquename;
	***REMOVED***
	function __construct($name){
		$this->uniquename = $name;
	***REMOVED***
	function getHumanName(){
		return ucfirst($this->uniquename);
	***REMOVED***

	function addValidator(ValidatorBase $v){
		$this->validators[] = $v;
		return $this;
	***REMOVED***

	abstract function setValue($value);
	abstract function getValue();
	abstract function render();

	function feedArray(){
		return $_GET;
	***REMOVED***
	function getSubmitValue(){
		$feed = $this->feedArray();
		return isset($feed[$this->uniquename]) ? $feed[$this->uniquename] : null;
	***REMOVED***


	function runValidators(){
		$errors = array();
		foreach ($this->validators as $validator) {
			$value = $this->getValue();
			if($validator->validateInput($value,$this)){
				return false;
			***REMOVED***
		***REMOVED***
		return true;
	***REMOVED***

	function error($title, $text){
		$this->errors[] = array("type" => "error","title"=>$title,"text"=>$text,"name" => $this->getHumanName());
	***REMOVED***

	function warning($title, $text){
		$this->errors[] = array("type" => "warning","title"=>$title,"text"=>$text,"name" => $this->getHumanName());
	***REMOVED***

	function getErrors(){
		return $this->errors;
	***REMOVED***

***REMOVED***