***REMOVED***

namespace spidfire\Elements;
use spidfire\Utilities\HtmlBuilder;

class SelectSteps extends Input{
  var $options = array();
  function options($options){
    $this->options = $options;
  ***REMOVED***

  function render(){
    $e = new HtmlBuilder('div.select-row');

    $e->addhtml('<script>
      function addStep(selected, value){
        var select = $(".selectedstep-" + selected);
        console.log(select);
        if(select.length == 0){
          console.log(value);
          $("#' . $this->getName() .'").val(value);

          var selectclasses = select.closest(".selectstep").attr("class");
          console.log(selectclasses);
          var selectdepth = selectclasses.substr(selectclasses.indexOf("selectdepth-") + 12, 1);
          
          for(var i = selectdepth; i < 10; i++){
            
            $(".selectdepth-" + i).hide();
          ***REMOVED***
        ***REMOVED*** else {
          $("#' . $this->getName() .'").val("");
        ***REMOVED***
        select.each(function(){
          var classes = $(this).attr("class");
          var depth = classes.substr(classes.indexOf("selectdepth-") + 12, 1);
          
          for(var i = depth; i < 10; i++){
            
            $(".selectdepth-" + i).hide();
          ***REMOVED***

          $(this).show();
        ***REMOVED***)
        
        
      ***REMOVED***
      $(".select-row").on("change", ".selectstep", function(){
       
        var classes = $(this).find(":selected").attr("class");
        var count = classes.indexOf("selectstep-") + 11;
        var sendvalue = $(this).find(":selected").val();
        var row = classes.substr(count);
        addStep(row, sendvalue);
      ***REMOVED***)
    </script><input type="hidden" id="' . $this->getName() . '" name="' . $this->getName() . '" value="' . $this->getValue() .'"></input>'); 
    //$e->attr('name', $this->getName());
    
    $this->makeSelect($e, $this->options, $this->getValue(), false);

    return $e->render();
  ***REMOVED***

  function makeSelect(HtmlBuilder $p, $data, $default, $hidden, $depth = 0, $name = ""){
    if($depth > 5){
      $this->error("Data problem","There is a infinite amount of data");
      return;
    ***REMOVED***
    $selected = false;
    
    $s = $p->add("select.form-control selectstep selectdepth-" . $depth . " " . $name . " ");
    $l = $s->add('optgroup')
      ->attr("label", "Selecteer een optie");
    //$s = $s->add('optgroup');
    $options = [];
    foreach ($data as $key => $value) {
      $t = $l->add('option.selectstep-' . $this->clean($key))
         ->attr('value',$key);
         
      if(is_array($value)){
        
        $t->addText($key);
      ***REMOVED*** else {
        if($key == $default){
          $t->attr('selected', true );
          $hidden = false;
          $selected = true;
        ***REMOVED***
        $t->addText($value);
      ***REMOVED***
      $options[$key] = $t;
    ***REMOVED***
    
    $tempdepth = $depth + 1;
    foreach ($data as $key => $value) {
      if(is_array($value)){
        $arr = $value;
        $optionselected = $this->makeSelect($p, $arr, $default, true, $tempdepth, "selectedstep-" . $this->clean($key));
        if($optionselected){
          $options[$key]->attr('selected', true );
          $hidden = false;
        ***REMOVED***
      ***REMOVED***
    ***REMOVED***
    if($hidden) {
      $hidden = "none";
    ***REMOVED*** else {
      $hidden = "block";
    ***REMOVED***
    $s->attr("style", "margin-bottom: 5px;display:" . $hidden);
    return $selected;
  ***REMOVED***

  function clean($string) {
     $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

     return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
  ***REMOVED***
  
***REMOVED***