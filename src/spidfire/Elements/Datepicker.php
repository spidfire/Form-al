***REMOVED***

namespace spidfire\Elements;
use spidfire\Validators\MinLength;
use spidfire\Utilities\HtmlBuilder;

class Datepicker extends Input{	

	function setValue($value){
		if(ctype_digit($value) || is_int($value))
			$this->value = $value;
		elseif(is_string($value))
			$this->value = strtotime($value);
		elseif(is_array($value)){
			$d = isset($value['d'])? $value['d'] : 0;	
			$m = isset($value['m'])? $value['m'] : 0;	
			$Y = isset($value['Y'])? $value['Y'] : 0;	
			$H = isset($value['H'])? $value['H'] : 1;	
			$i = isset($value['i'])? $value['i'] : 0;	
			$s = isset($value['s'])? $value['s'] : 0;	
			$this->value = mktime($H,$i,$s,$m,$d,$Y);
		***REMOVED***else{
			$this->value = time();
		***REMOVED***
	***REMOVED***
	function getValue(){
		$submit = $this->getSubmitValue();
		if($submit != null)
			$this->setValue($submit);
		
		if(ctype_digit($this->value) || is_int($this->value))
			return $this->value;
		else
			return time();
		
	***REMOVED***


	var $months = array(
		'1' => 'Jan',
		'2' => 'Feb',
		'3' => 'Mrt',
		'4' => 'Apr',
		'5' => 'Mei',
		'6' => 'Jun',
		'7' => 'Jul',
		'8' => 'Aug',
		'9' => 'Sep',
		'10' => 'Okt',
		'11' => 'Nov',
		'12' => 'Dec',
);

	function render(){
		$e = new HtmlBuilder('div.form-control');
		$days = array();
		for ($i=1; $i <= 31; $i++)
			$days[$i] = $i;

		$this->createSelect($e,'d', $this->numberRange(1,31));
		$e->addText('-');
		$this->createSelect($e,'m', $this->months);
		$e->addText('-');		
		$this->createSelect($e,'Y', $this->numberRange(2000,2020));

		$this->createSelect($e,'H', $this->numberRange(1,24));
		$e->addText(':');		
		$this->createSelect($e,'i', $this->numberRange(0,60));
		$e->addText(':');		
		$this->createSelect($e,'s', $this->numberRange(0,60));
		// $e->addText(date("d-m-Y H:i:s",$this->getValue()));		
		return $e->render();
	***REMOVED***

	function numberRange($start,$end,$steps=1){
		$years = array();
		for ($i=$start; $i < $end; $i++)
			$years[$i] = $i;
		return $years;
	***REMOVED***
	function createSelect(HtmlBuilder $p, $modifier,$options){
		$sel = $p->add('select')
		  ->attr('name', $this->getName()."[".$modifier."]");
		foreach ($options as $key => $value) {
			$sel->add('option')
				 ->attr('value',$key)
				 ->attr('selected', ($key == date($modifier, $this->getValue()) ? 'selected' : null) )
				 ->addText($value);
		***REMOVED***
	***REMOVED***


	function min($length){
		$this->addValidator(new MinLength($length));
		return $this;
	***REMOVED***
***REMOVED***