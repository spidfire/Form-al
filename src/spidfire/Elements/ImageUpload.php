<?php

namespace spidfire\Elements;
use spidfire\ElementBase;
use spidfire\Utilities\HtmlBuilder;
use spidfire\Utilities\MimeType;

class ImageUpload extends Input{
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
				  ->attr('src', "http://almanapp.nl/inleveren/images/" .$this->getValue()); // displays image
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

		try {
		    
		    // Undefined | Multiple Files | $_FILES Corruption Attack
		    // If this request falls under any of them, treat it invalid.
		    if (
		        !isset($file['error']) ||
		        is_array($file['error'])
		    ) {
		        $this->error("Upload error", "Er is een onbekende fout bij het uploaden van het bestand");
		    return false;
		    }

		    // Check $file['error'] value.
		    switch ($file['error']) {
		        case UPLOAD_ERR_OK:
		            break;
		        case UPLOAD_ERR_NO_FILE:
		            $this->error("Upload error", "Het opgegeven bestand is niet gevonden");
		            return false;
		        case UPLOAD_ERR_INI_SIZE:
		        case UPLOAD_ERR_FORM_SIZE:
		            $this->error("Upload error", "Het opgegeven bestand is te groot.(f)");// form
		            return false;
		        default:
		            $this->error("Upload error", "Er is een onbekende fout opgetreden.");
		            return false;
		    }

		    // You should also check filesize here. 
		    if ($file['size'] > 1000000) {
		        $this->error("Upload error", "Het opgegeven bestand is te groot.(s)"); // servercheck
		    }


		    if(class_exists('finfo')){
			    // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
			    // Check MIME Type by yourself.
			    $finfo = new \finfo(FILEINFO_MIME_TYPE);
			    if (false === $ext = array_search(
			        $finfo->file($file['tmp_name']),
			        array(
			            'jpg' => 'image/jpeg',
			            'png' => 'image/png',
			            'gif' => 'image/gif',
			        ),
			        true
			    )) {
			         $this->error("Upload error", "Het geuploade bestand is geen foto (jpg, png, gif)");
			    }
		    }else{
		    	$path_parts = pathinfo($file['name']);
		    	
		    	$ext = $path_parts['extension'];
		    }
		    // var_dump($ext);

		    // You should name it uniquely.
		    // DO NOT USE $file['name'] WITHOUT ANY VALIDATION !!
		    // On this example, obtain safe unique name from its binary data.
		    $target = sprintf('%s.%s',sha1_file($file['tmp_name']),$ext);
		    $target_plus_dir = $this->local_path. "/". $target;
		    if (!move_uploaded_file($file['tmp_name'], $target_plus_dir)) {
		        $this->error("Upload error", "Er is een fout opgetreden bij het uploaden");
		        return false;
		    }

		    return $target;

		} catch (RuntimeException $e) {

		    $this->error("Upload Exception ", $e->getMessage());
	        return false;

		}

	}

}
