***REMOVED***

namespace spidfire\Elements;
use spidfire\ElementBase;
use spidfire\Utilities\HtmlBuilder;
use spidfire\Utilities\MimeType;

class ImageUploadToServer extends Input{
	var $public_path = "images/";
	var $local_path = "images/";
	private $is_uploaded = false;
	function setValue($value){
		$this->value =  $value;
	***REMOVED***

	function getValue(){
		
		if($this->is_uploaded !== false){
			return $this->is_uploaded;
		***REMOVED***elseif(isset($_FILES[$this->getName()]) && !empty($_FILES[$this->getName()]['name'])){
			if($this->is_uploaded === false){
				if(($file = $this->verifyFile($_FILES[$this->getName()])) !== false){
					$this->is_uploaded = $file;
					return $file;
				***REMOVED***else{
					$this->error("fuu","foobar");
					return "FOOOO";
				***REMOVED***
			***REMOVED***else{
				return $this->is_uploaded;
			***REMOVED***
		***REMOVED***elseif(isset($_POST[$this->getName()])){
			return $_POST[$this->getName()];
		***REMOVED***else{
			return $this->value;
		***REMOVED***
	***REMOVED***


	function render(){
		$e = new HtmlBuilder('div');
		if(!empty($this->getValue())){
			$inp = $e->add('input.form-control')
			  ->attr('type','hidden')
			  ->attr('name', $this->getName())
			  ->attr('value', $this->getValue());
		***REMOVED***
		if(isset($GLOBALS['showimageinputhack']) && !empty($this->getValue())){			
				$inp = $e->add('img')
				  ->attr('class','superuberimagehack')
				  //->attr('name', $this->getName())
				  ->attr('src', \MediaServerUtilities::createUrl('get', $this->getValue())); // displays image
				$inp = $e->add('input.form-control')
					->attr('type','file')
					->attr('name', $this->getName()); // for changing the current image
			
		***REMOVED***else{
			$inp = $e->add('input.form-control')
			  ->attr('type','file')
			  ->attr('name', $this->getName());
		***REMOVED***
		
		return $e->render();
	***REMOVED***


	function verifyFile($file){
		$var = \StorageServerModel::storePicture($file);
		return $var;

	***REMOVED***

***REMOVED***