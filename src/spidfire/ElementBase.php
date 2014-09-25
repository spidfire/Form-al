***REMOVED***

namespace spidfire;


abstract class ElementBase{
	private $uniquename;
	private $formal;
	private $errors = array();
	private $validators = array();
	private $transformers = array();
	var $full_width = false; // must a div with full with be used?
	var $mark_for_export = true; // Must this element be exported
	var $value = null;

	final function getName(){
		return $this->getFormAl()->getName().$this->getUniquenName();
	***REMOVED***
	final function getUniquenName(){
		return $this->uniquename;
	***REMOVED***

	function usesFullWidth(){
		return $this->full_width;
	***REMOVED***
	function __construct($name, FormAlAbstract $formal){
		$this->uniquename = $name;
		$this->formal = $formal;
	***REMOVED***

	function getFormAl(){
		return $this->formal;
	***REMOVED***

	function getLabel(){
		return ucfirst($this->getUniquenName());
	***REMOVED***

	function addValidator(ValidatorBase $v){
		$this->validators[] = $v;
		return $this;
	***REMOVED***

	abstract function render();

	function setValue($value){
		$this->value =  $value;
		return $this;
	***REMOVED***
	function defaultValue($value){
		if(is_null($this->value)){
			$this->value = $value;
		***REMOVED***
		return $this;
	***REMOVED***

	function getValue(){
		$submit = $this->getSubmitValue();
		if($submit != null)
			return $submit;
		else
			return $this->value;
		
	***REMOVED***
	function getSubmitValue(){
		$update = $this->getFormAl()->updatedValues();

		return isset($update[$this->getName()]) ? $update[$this->getName()] : null;
	***REMOVED***


	private function runValidators(){
		$this->errors = array();
		foreach ($this->validators as $validator) {
			$value = $this->getValue();
			if($validator->validateInput($value,$this) == false){
				return false;
			***REMOVED***
		***REMOVED***
		return true;
	***REMOVED***
	function notNull(){
		$this->addValidator(new Validators\NotNull());
		return $this;
	***REMOVED***

	function error($title, $text,$type='error'){
		$fieldname = $this->getLabel();
		$msg = "In het veld '".$fieldname."' is een fout opgetreden!<br/>\n";
		$msg .= "<strong>".$title."</strong> ".$text." <br/>\n";
		$this->errors[] = array(
			"type" => $type,
			"title"=>$title,
			"text"=>$text,
			"name" => $fieldname, 
			"msg"=> $msg
***REMOVED***
	***REMOVED***

	function warning($title, $text){
		return $this->error($title,$text,'warning');
	***REMOVED***

	function getErrors(){
		if(!$this->runValidators()){
			return $this->errors;			
		***REMOVED***
		return array();
	***REMOVED***


***REMOVED***