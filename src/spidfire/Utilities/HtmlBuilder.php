***REMOVED***

namespace spidfire\Utilities;

class HtmlBuilder{
	private $name = '';
	private $attr = array();
	private $add = array();

	static function create($name){
		return new self($name);
	***REMOVED***
	function __construct($name){
		//automatic class attribute creation
		if(strstr($name, ".")){			
			list($name,$classes) = explode(".", $name,2);
			if(!empty($classes)){
				$this->attr("class",str_replace('.',' ',$classes));
			***REMOVED***
		***REMOVED***
		$this->name = htmlspecialchars($name);
	***REMOVED***

	function attr($name,$value){
		if($value !== null)
			$this->attr[$name] = $value;
		return $this;
	***REMOVED***
	function style($style){
		if(is_array($style)){
			$concattedstyle = "";
			foreach ($variable as $key => $value) {
				$concattedstyle[] = $key.":".$value;
			***REMOVED***
			$concattedstyle = implode(";", $concattedstyle);
			$this->attr('style',$concattedstyle);
		***REMOVED***elseif(is_string($style)){
			$this->attr('style',$style);
		***REMOVED***else{
			throw new Exception("Unkown type for style in HtmlBuilder", 1);
			
		***REMOVED***
		return $this;

	***REMOVED***
	function nl(){
		$this->addHtml("<br/>\n");
		return $this;
	***REMOVED***
	function add($name){
		$el = new HtmlBuilder($name);;

		$this->add[] = array('type'=> 'htmlbuilder', 'data'=>$el);
		return $el;
	***REMOVED***
	function addText($text){
		$this->add[] = array('type'=> 'text', 'data'=>$text);
		return $this;
	***REMOVED***

	function addHtml($text){
		$this->add[] = array('type'=> 'html', 'data'=>$text);
		return $this;
	***REMOVED***
	function template($variables=array()){
		$html = $this->render();
		foreach ($variables as $key => $value) {
			$html = preg_replace("/{{\s*".$key."\s****REMOVED******REMOVED***/is", $value, $html);
		***REMOVED***	
		return $html;

	***REMOVED***
	function jsHtml(){
		$html  = "$('<".$this->name."/>')\n";
		$html .= ".attr(".json_encode($this->attr).")\n";
		if(count($this->add) > 0){
			foreach ($this->add as $el) {
				switch($el['type']){
					case 'htmlbuilder':
						$html .= ".append(".$el['data']->jsHtml().")\n";
					break;
					case 'html':
						$html .= ".append(".json_encode($el['data']).")\n";
					break;
					case 'text':
						$html .= ".append($(".json_encode($el['data']).").text())\n";
					break;					
				***REMOVED***
			***REMOVED***
		***REMOVED***
		return $html;

			
	***REMOVED***

	function render(){
		$html = "<".$this->name;
		
		foreach ($this->attr as $key => $value) {
			if(is_array($value))
				throw new Exception("The value of the attribute '$key' is an array!", 1);
			elseif(!is_null($value))
				$html .= " ".$key."=\"".htmlentities($value)."\"";				
		***REMOVED***

		if(count($this->add) > 0){
			$html .= ">";
			foreach ($this->add as $el) {
				switch($el['type']){
					case 'htmlbuilder':
						$html .= $el['data']->render()."\n";
					break;
					case 'html':
						$html .= $el['data']."\n";
					break;
					case 'text':
						$html .= htmlspecialchars($el['data']);
					break;					
				***REMOVED***
			***REMOVED***
			
			$html .= "</".$this->name.">";
		***REMOVED***else{
			$singletags = array('input');
			if(in_array($this->name,$singletags))
				$html .= "/>";
			
			else
				$html .= "></".$this->name.">";

			
		***REMOVED***
		return $html;
	***REMOVED***

	function __toString(){
		throw new Exception("HtmlBuilder Can not be used as a part of a string!", 1);
		
	***REMOVED***

***REMOVED***