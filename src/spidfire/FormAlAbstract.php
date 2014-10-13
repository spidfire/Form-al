***REMOVED***
namespace spidfire;

abstract class FormAlAbstract
{
    private $uniquename;
    private $element_storage = array();
    private $elements = array();
    private $plugins = array();
    private $phase = 0;
    const PHASE_SETUP = 0;
    const PHASE_USAGE = 1;
    
    function __construct($name) {
        $this->uniquename = $name;
    ***REMOVED***
    
    final function getName() {
        return $this->uniquename;
    ***REMOVED***
    function setName($uniquename){
        $this->uniquename = $uniquename;
    ***REMOVED***
    function addElement(ElementBase $el) {
        if ($this->phase != self::PHASE_SETUP) throw new \Exception("Setup phase is passed", 1);
        
        $this->elements[] = $el;
    ***REMOVED***
    
    function exportForm() {
        return serialize($this);
    ***REMOVED***

    function importForm($value){
        return unserialize($value); 
    ***REMOVED***

    function runPlugins(){
        foreach($this->plugins as $plugin){
            $plugin->run();
        ***REMOVED***
    ***REMOVED***

    function addPlugin($plugin){
        array_push($this->plugins, $plugin);

    ***REMOVED***
    function export() {
        if ($this->phase == self::PHASE_SETUP) $this->phase = self::PHASE_USAGE;
        $out = array();
        foreach ($this->elements as $el) {
            if($el->mark_for_export == true){                
                $name = $el->getUniqueName();
                $value = $el->getValue();
                $out[$name] = $value;
            ***REMOVED***
        ***REMOVED***
        return $out;
    ***REMOVED***
    function getErrors() {
        $errors = array();
        foreach ($this->elements as $el) {
            foreach ($el->getErrors() as $e) {
                $errors[] = $e;
            ***REMOVED***
        ***REMOVED***
        return $errors;
    ***REMOVED***
    function hasErrors() {
        return count($this->getErrors()) > 0;
    ***REMOVED***
    function hasNoErrors() {
        return !$this->hasErrors();
    ***REMOVED***
    
    function updatedValues() {
        return array();
    ***REMOVED***
    
    function import($data) {
        if (is_array($data)) {
            foreach ($this->elements as $el) {
                //echo $el->getUniqueName() . "<br>";
                if (isset($data[$el->getUniqueName() ])) {
                    $el->setValue($data[$el->getUniqueName() ]);
                ***REMOVED***
            ***REMOVED***
        ***REMOVED*** else {
            throw new \Exception("Form-Al Import is not using an array", 1);
        ***REMOVED***
    ***REMOVED***
    
    function getElements() {
        return $this->elements;
    ***REMOVED***
    
    function getElement($name){
        foreach($this->elements as $element){
            if($element->getUniqueName() == $name){
                return $element;
            ***REMOVED***
        ***REMOVED***
        Throw new \Exception("This element does not exist", 1);
    ***REMOVED***
    abstract function render();
    
    var $callables = array();
    
    function __call($name, $args) {
        if (isset($this->callables[$name])) {
            $elment = $this->callables[$name];
            $args[0] = isset($args[0]) ? $args[0] : false;
            if (count($args) == 0) $el = new $elment($this);
            elseif (count($args) == 1) $el = new $elment($args[0], $this);
            elseif (count($args) == 2) $el = new $elment($args[0], $args[1], $this);
            elseif (count($args) == 3) $el = new $elment($args[0], $args[1], $args[2], $this);
            else throw new \Exception("invalid amount of arguments in $name");
            
            $this->addElement($el);
            return $el;
        ***REMOVED*** else {
            throw new \Exception("The function $name is not found on this class");
        ***REMOVED***
    ***REMOVED***
***REMOVED***
