***REMOVED***

namespace FormAl\Elements;

use FormAl\ElementBase;
use FormAl\FormAlAbstract;

/**
 * Class Input
 *
 * @package FormAl\Elements
 */
class FoldGroup extends ElementBase
{
    /** @var ElementBase[] */
    private $elements = [];
    /** @var string */
    private $labelname = "";

    /**
     * @param string         $name
     * @param FormAlAbstract $formal
     */
    public function __construct($name, FormAlAbstract $formal)
    {
        parent::__construct($name, $formal);
        $this->markForExport = false;
    ***REMOVED***

    /**
     * @param string $text
     *
     * @return $this
     */
    public function label($text)
    {
        $this->labelname = $text;

        return $this;
    ***REMOVED***

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->labelname;
    ***REMOVED***

    /**
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        // this class doesn't render itself
        return "";
    ***REMOVED***

    /**
     * @param ElementBase $element
     *
     * @return $this
     */
    public function addElement(ElementBase $element)
    {
        $element->setFolded(true);
        $this->elements[] = $element;

        return $this;
    ***REMOVED***

    /**
     * @param array $elements
     *
     * @return $this
     */
    public function addElements(array $elements)
    {
        foreach ($elements as $el) {
            $this->addElement($el);
        ***REMOVED***

        return $this;
    ***REMOVED***

    /**
     * @return \FormAl\ElementBase[]
     */
    public function getElements()
    {
        return $this->elements;
    ***REMOVED***
***REMOVED***
