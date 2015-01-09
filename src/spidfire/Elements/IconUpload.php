***REMOVED***

namespace spidfire\Elements;
use spidfire\ElementBase;
use spidfire\FormAlAbstract;
use spidfire\Utilities\HtmlBuilder;
use spidfire\Utilities\MimeType;

class IconUpload extends Input{
	function setValue($value){
		if(preg_match("/fa-.*/",$value)){
			$this->value =  "fontawesome";
			$this->extend_fields['fontawesome']->setValue($value);
		***REMOVED***elseif(preg_match("/colorchange/",$value)){
			$parse = parse_url($value);
			parse_str($parse['query'],$parts);
			$this->value =  "typeicon";
			$this->extend_fields['iconVal']->setValue($value);
			$this->extend_fields['icon_color']->setValue("#".$parts['color']);
    ***REMOVED***elseif(preg_match("/flaticons/",$value)){
      $this->value =  "typeicon";
      $this->extend_fields['iconVal']->setValue($value);
		***REMOVED***elseif(!empty($value)){
			$this->value =  "typeimage";
			$this->extend_fields['imageupload']->setValue($value);
		***REMOVED***else{			
			$this->value =  "typeicon";
			$this->extend_fields['iconVal']->setValue($value);
		***REMOVED***
	***REMOVED***

	var $extend_fields = array();
	function __construct($name, FormAlAbstract $formal){
		$this->extend_fields['icon_color'] = new Colorpicker('icon_color', $formal);	
		$this->extend_fields['iconVal'] = new Input('iconVal', $formal);
		$this->extend_fields['imageupload'] = new ImageUploadToServer('imageupload', $formal);
		$this->extend_fields['fontawesome'] = new FaIconPicker('fontawesome', $formal);
		parent::__construct($name,$formal);
	***REMOVED***
	function getValue(){
		$icondetails = $this->getValueIntern();
		if ($icondetails['selected'] == "typeicon") {
      		$icondetails['icon'] = $icondetails['iconVal'];
      		$icondetails['icon_color'] = str_replace("#", "", $icondetails['icon_color']);
      		if (strpos($icondetails['icon'], "color=") > -1) {
      			$icondetails['icon'] = substr( $icondetails['icon'], 53);
      		***REMOVED***
          $icondetails['icon'] = str_replace(' ', '%20', $icondetails['icon']);
      		return  "http://almanapp.nl/m/colorchange/?color=".$icondetails['icon_color']."&image=".$icondetails['icon'];
      	***REMOVED***else if ($icondetails['selected'] == "typeimage") {
      		return $icondetails['imageupload'];
      	***REMOVED***else if ($icondetails['selected'] == "fontawesome") {
      		return $icondetails['fontawesome'];
      	***REMOVED***

		return $out;
	***REMOVED***
	function getValueIntern(){
		$out = array();
		foreach ($this->extend_fields as $key => $value) {
			$out[$key] = $value->getValue();
		***REMOVED***
		$out['selected'] = (isset($_POST[$this->getName()])) ? $_POST[$this->getName()] : $this->value;
		return $out;
	***REMOVED***
	function render(){

		$pageVars = array();
		$e = new HtmlBuilder('div');
		$select = $e->add('select')
				  	->attr('class', 'form-control imgtype')
				  	->attr('name', $this->getName())
				  	->attr('onchange', 'changeImageSelect(this)');
		$values = $this->getValueIntern();
		$pageVars['menu'] = $values;
		$options = array(
			'typeicon' => 'Icon selecteren uit lijst',
			'typeimage' => 'Afbeelding uploaden als icon',
			'fontawesome' => 'Fontawesome',
	***REMOVED***
	  	foreach ($options as $key => $value) {
			$select->add('option')
			 ->attr('value',$key)
			 ->attr('selected', ($key == $values['selected'] ? 'selected' : null) )
			 ->addText($value);
			
		***REMOVED***
		$this->extend_fields['iconVal']->type = 'hidden';	

		$inp = $e->addHtml('<br>');

		$inp = $e->addHTML('
        	<div class="icondiv">
            	<br>
            	<a class="fancybox" href="#inline1" title="Choose an icon">
                {% if menu.iconVal is empty %***REMOVED***
                <img id="image" style="height:50px; width:50px; background-color: #D1D1D1;" src="{{ROOT***REMOVED******REMOVED***template\img\no-available-image.png" alt="Image not found">
                {% else %***REMOVED***
                <img id="image" style="height:50px; cursor:pointer; background-color: #D1D1D1;" id="img_{{menu.id***REMOVED******REMOVED***" src="{{menu.iconVal***REMOVED******REMOVED***" alt="image" onClick="window.open(document.getElementById(\'img_{{menu.id***REMOVED******REMOVED***\').src);">
                {% endif %***REMOVED***
                </a>
                '. $this->extend_fields['iconVal']->render() .'
                <br><br>
                <p class="help-block">
                    {{ "Select an image"|trans ***REMOVED******REMOVED*** {{ menu.iconVal!="" ? "; However, this will replace the existing icon"|trans : "" ***REMOVED******REMOVED***
                </p>
                '. $this->extend_fields['icon_color']->render() .
                '
             	<div id="inline1" style="width:800px;max-height: 800;background-color: #D1D1D1;display: none;">
             		<input type="text" id="searchbar" style="
             		display: block;
             		padding: 5px 5px 5px 5px;
             		width: 100%;
             		font-family: sans-serif;
             		font-size: 18px;
             		appearance: none;
             		box-shadow: none;
             		border-radius: none;
             		" placeholder="{{"Search"|trans***REMOVED******REMOVED***" onkeyup="showImagesByAlt()">
             		<br><br>
                   	{% for img in images %***REMOVED***
                   		<img src="http://m.almanapp.nl/flat/flaticons/{{ img ***REMOVED******REMOVED***" alt="{{img***REMOVED******REMOVED***" style="width: 100px;height: 100px;display: inline-block; padding: 10px;" onclick="saveUrl(\'{{ img ***REMOVED******REMOVED***\')">
                   	{% endfor %***REMOVED***
               </div>
            </div>

            <script type="text/javascript">
            	$(document).ready(function() {
            		$(".fancybox").fancybox();

            		$(".icondiv").show();
            		$(".imagediv").hide();
            	***REMOVED***);

            	function showImagesByAlt() {
            		var search = document.getElementById("searchbar").value;
            		var allImages = document.getElementsByTagName("img");
            		for (var i = 0, leng = allImages.length; i < leng; ++i) {
            			if (allImages[i].alt.toLowerCase().indexOf(search.toLowerCase()) > -1) {
            				allImages[i].style.display=\'inline-block\';
            			***REMOVED*** else {
            				allImages[i].style.display=\'none\';
            			***REMOVED***
            		***REMOVED***
            	***REMOVED***

            	function saveUrl(url) {
            		var elem = $(\'[name='.$this->extend_fields['iconVal']->getName().']\');
            		elem.val("http://m.almanapp.nl/flat/flaticons/" + url);
            		var elem = document.getElementById("image");
            		elem.src = "http://m.almanapp.nl/flat/flaticons/" + url;
            		$.fancybox.close();
            	***REMOVED***

            	function changeImageSelect(select) {
            		var value = select.value;
            		if (value == "typeicon") {
            			$(".icondiv").show();
            			$(".imagediv").hide();
            			$(".fontawesomediv").hide();
            		***REMOVED*** else if (value == "typeimage") {
            			$(".icondiv").hide();
            			$(".imagediv").show();
            			$(".fontawesomediv").hide();
            		***REMOVED*** else {
            			$(".icondiv").hide();
            			$(".imagediv").hide();
            			$(".fontawesomediv").show();
            		***REMOVED***
            	***REMOVED***

            	function changeBorderColor(input) {
            		input.style.borderColor = input.value;
            	***REMOVED***
            	$(function(){
            		var value = "'.$values['selected'].'";
            		if (value == "typeicon") {
            			$(".icondiv").show();
            			$(".imagediv").hide();
            			$(".fontawesomediv").hide();
            		***REMOVED*** else if (value == "typeimage") {
            			$(".icondiv").hide();
            			$(".imagediv").show();
            			$(".fontawesomediv").hide();
            		***REMOVED*** else if (value == "fontawesome"){
            			$(".icondiv").hide();
            			$(".imagediv").hide();
            			$(".fontawesomediv").show();
            		***REMOVED*** else {
                  $(".icondiv").show();
                  $(".imagediv").hide();
                  $(".fontawesomediv").hide();
                ***REMOVED***

            	***REMOVED***)

            </script>
            <div class="imagediv">
            '. $this->extend_fields['imageupload']->render() .'
            </div>
            <div class="fontawesomediv">
            '. $this->extend_fields['fontawesome']->render() .'
            </div>

            ');

		$pageVars['images'] = self::getIcons();
		return \CORE::openPage($e->render(), $pageVars, true);
	***REMOVED***

	public static function getIcons(){
		$json = file_get_contents('http://m.almanapp.nl/flat/flaticons/getIcons.php');
		$icons = json_decode($json);
		$newicons = array();
		foreach ($icons as $icon) {
			if(strpos($icon, '.png') !== false) {
				$newicons[] = $icon;
			***REMOVED***
		***REMOVED***
		return $newicons;
	***REMOVED***


	function verifyFile($file){
		$var = \StorageServerModel::storePicture($file);
		return $var;

	***REMOVED***

***REMOVED***