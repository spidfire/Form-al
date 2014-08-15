***REMOVED***

namespace spidfire\Utilities;

class HtmlBuilder{
	private $name = '';
	private $attr = array();
	private $add = array();

	function __construct($name){
		$this->name = htmlspecialchars($name);
	***REMOVED***

	function attr($name,$value){
		if($value !== null)
			$this->attr[$name] = $value;
		return $this;
	***REMOVED***

	function add($name){
		$el = new HtmlBuilder($name);;

		$this->add[] = $el;
		return $el;
	***REMOVED***
	function addText($text){
		$this->add[] = $text;
		return $this;
	***REMOVED***

	function render(){
		$html = "<".$this->name;
		
		foreach ($this->attr as $key => $value) {
			if(is_string($value)){
				$html .= " ".$key."=\"".htmlentities($value)."\"";				
			***REMOVED***
		***REMOVED***

		if(count($this->add) > 0){
			$html .= "/>";
			foreach ($this->add as $el) {
				if($el instanceof HtmlBuilder){
					$html .= $el->render()."\n";					
				***REMOVED***else{
					$html .= htmlspecialchars($el);
				***REMOVED***
			***REMOVED***
			
			$html .= "</".$this->name.">";
		***REMOVED***else{
			$html .= "/>";
		***REMOVED***
		return $html;
	***REMOVED***



***REMOVED***