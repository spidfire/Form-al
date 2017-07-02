***REMOVED***

namespace FormAl\Elements;

use FormAl\Utilities\HtmlBuilder;

/**
 * Class Checkbox
 *
 * @package FormAl\Elements
 */
class Checkbox extends Input
{
    /** @var string */
    public $trueValue = '1';
    /** @var string */
    public $falseValue = '0';

    /**
     * @return null|string
     */
    public function getValue()
    {
        $submit = $this->getSubmitValue();
        $update = $this->getFormAl()->updatedValues();
        $isSubmitted = array_key_exists(
            $this->getName() . "_submitted",
            $update
        );

        if (is_null($submit)) {
            if ($isSubmitted == true) {
                return $this->falseValue;
            ***REMOVED*** else {
                return $this->value;
            ***REMOVED***
        ***REMOVED*** else {
            if (strcasecmp((string)$submit, (string)$this->trueValue) == 0) {
                return $this->trueValue;
            ***REMOVED*** else {
                return $this->falseValue;
            ***REMOVED***
        ***REMOVED***
    ***REMOVED***

    /**
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        $checked = null;

        if ($this->getValue() == $this->trueValue) {
            $checked = 'checked';
        ***REMOVED***

        $element = new HtmlBuilder('input');
        $element->attr('type', 'checkbox')
            ->attr('name', $this->getName())
            ->attr('checked', $checked)
            ->attr('value', $this->trueValue);

        $tooltip = "";
        if (empty($this->getTooltip()) == false) {
            $tooltip = " " . $this->getTooltip();
            $this->setTooltip("");
        ***REMOVED***
        // hidden for submission check
        $hidden = new HtmlBuilder('input');
        $hidden->attr('type', 'hidden')
            ->attr('name', $this->getName() . "_submitted")
            ->attr('value', 'yes');

        return $element->render() . $tooltip . $hidden->render();
    ***REMOVED***
***REMOVED***