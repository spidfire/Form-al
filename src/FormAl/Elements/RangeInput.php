***REMOVED***

namespace FormAl\Elements;

use FormAl\ElementBase;
use FormAl\Utilities\HtmlBuilder;

/**
 * Class RangeInput
 *
 * @package FormAl\Elements
 */
class RangeInput extends ElementBase
{
    /** @var string */
    private $labelname = "";
    /** @var string */
    public $type = "range";
    /** @var int */
    public $min = 0;
    /** @var int */
    public $max = 100;

    /**
     * @param string $label
     *
     * @return $this
     */
    public function label($label)
    {
        $this->labelname = $label;

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
     * @param string $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    ***REMOVED***

    /**
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        $element = new HtmlBuilder('div');
        $uniquename = 'rangeinput_' . md5($this->getName());

        $inputDiv = $element->add('div')
            ->attr('style', 'overflow: auto;');

        $inputDiv->add('input.form-control')
            ->attr('type', $this->type)
            ->attr('name', $this->getName())
            ->attr('value', $this->getValue())
            ->attr('min', $this->min)
            ->attr('max', $this->max)
            ->attr('style', 'float: left; margin-left; margin-bottom: 15px;')
            ->attr(
                'oninput',
                'updateRangeOutput_' . $uniquename . '(this.value);'
            );

        $inputDiv->add('output')
            ->attr('id', $uniquename . '_rangeoutput')
            ->attr('value', $this->getValue() . "%")
            ->attr(
                'style',
                'float: left; padding-left: 10px; margin-left: 50px; position: relative;'
            )
            ->addText($this->getValue() . '%');

        $element->add('script')
            ->addHtml(
                "
                function updateRangeOutput_" . $uniquename . "(value) {
                    document.getElementById('" . $uniquename . "_rangeoutput" . "').value = value + '%'; 
                ***REMOVED***
            "
            );

        return $element->render();
    ***REMOVED***
***REMOVED***
