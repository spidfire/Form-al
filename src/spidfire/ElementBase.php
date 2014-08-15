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


	function addValidator(ValidatorBase $v){
		$this->validators[] = $v;
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

***REMOVED***