***REMOVED***

namespace spidfire;


class FormAl extends FormAlAbstract{	

	function render(){
		$errors = array();
		foreach ($this->getelements() as $el) {
			$el->runValidators();
			$errors = array_merge($errors, $el->getErrors());
		***REMOVED***
		foreach ($errors as $key => $value) {
			echo "<div>".$value['name']. ", has an error: <strong>".$value['title']."</strong><p>".$value['text']."</p></div>";
		***REMOVED***
		$html = "<form>";
		foreach ($this->getelements() as $el) {
			$html .= $el->render()."<Br/>";
		***REMOVED***
		$html .= "</form>";
		return $html;
	***REMOVED***

	var $callables = array(
		"input" => "spidfire\Elements\Input",
		"password" => "spidfire\Elements\Password",
		"submit" => "spidfire\Elements\Submit",
***REMOVED***


***REMOVED***