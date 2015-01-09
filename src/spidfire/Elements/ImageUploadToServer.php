<?php

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
	}

	function getValue(){
		
		if($this->is_uploaded !== false){
			return $this->is_uploaded;
		}elseif(isset($_FILES[$this->getName()]) && !empty($_FILES[$this->getName()]['name'])){
			if($this->is_uploaded === false){
				if(($file = $this->verifyFile($_FILES[$this->getName()])) !== false){
					$this->is_uploaded = $file;
					return $file;
				}else{
					$this->error("fuu","foobar");
					return "FOOOO";
				}
			}else{
				return $this->is_uploaded;
			}
		}elseif(isset($_POST[$this->getName()])){
			return $_POST[$this->getName()];
		}else{
			return $this->value;
		}
	}


	function render(){
		$e = new HtmlBuilder('div');
		if(!empty($this->getValue())){
			$inp = $e->add('input.form-control')
			  ->attr('type','hidden')
			  ->attr('name', $this->getName())
			  ->attr('value', $this->getValue());
		}
		if(isset($GLOBALS['showimageinputhack']) && !empty($this->getValue())){			
				$inp = $e->add('img')
				  ->attr('class','superuberimagehack')
				  //->attr('name', $this->getName())
				  ->attr('src', \MediaServerUtilities::createUrl('get', $this->getValue())); // displays image
				$inp = $e->add('input.form-control')
					->attr('type','file')
					->attr('name', $this->getName()); // for changing the current image
			
		}else{
			$inp = $e->add('input.form-control')
			  ->attr('type','file')
			  ->attr('name', $this->getName());
		}
		
		return $e->render();
	}


	function verifyFile($file){
		$var = \StorageServerModel::storePicture($file);
		return $var;

	}

}