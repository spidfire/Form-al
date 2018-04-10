***REMOVED***

namespace FormAl\Elements;

use FormAl\ElementBase;
use FormAl\Utilities\HtmlBuilder;
use FormAl\Validators\MinIntValue;

/**
 * Class Integer
 *
 * @package FormAl\Elements
 */
class Integer extends ElementBase
{
    /** @var string */
    public $type = "number";
    /** @var string */
    private $labelname = "";

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
        $element = new HtmlBuilder('input.form-control');
        $element->attr('type', $this->type)
            ->attr('name', $this->getName())
            ->attr('value', $this->getValue());

        return $element->render();
    ***REMOVED***

    /**
     * @param int $length
     *
     * @return $this
     */
    public function min($length)
    {
        $this->addValidator(new MinIntValue($length));

        return $this;
    ***REMOVED***

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return $this->getValue() === null;
    ***REMOVED***
***REMOVED***
