***REMOVED***
namespace spidfire;

abstract class FormAlAbstract
{
    private $uniquename;
    
    private $elements = array();
    function __construct($name) {
        $this->uniquename = $name;
    ***REMOVED***
    
    function addElement(ElementBase $el) {
        $this->elements[] = $el;
    ***REMOVED***
    
    function export() {
        $out = array();
        foreach ($this->elements as $el) {
            $name = $el->getName();
            $value = $el->getValue();
            $out[$name] = $value;
        ***REMOVED***
        return $out;
    ***REMOVED***
    function getElements() {
        return $this->elements;
    ***REMOVED***
    
    abstract function render();
    
    var $callables = array();
    
    function __call($name, $args) {
        if (isset($this->callables[$name])) {
            $elment = $this->callables[$name];
            if (count($args) == 0) $el = new $elment();
            elseif (count($args) == 1) $el = new $elment($args[0]);
            elseif (count($args) == 2) $el = new $elment($args[0], $args[1]);
            elseif (count($args) == 3) $el = new $elment($args[0], $args[1], $args[2]);
            else throw new Exception("invalid amount of arguments in $name");
            
            $this->addElement($el);
            return $el;
        ***REMOVED*** else {
            throw new Exception("The function $name is not found on this class");
        ***REMOVED***
    ***REMOVED***
***REMOVED***
