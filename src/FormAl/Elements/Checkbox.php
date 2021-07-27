<?php

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
            } else {
                return $this->value;
            }
        } else {
            if (strcasecmp((string)$submit, (string)$this->trueValue) == 0) {
                return $this->trueValue;
            } else {
                return $this->falseValue;
            }
        }
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        $checked = null;

        if ($this->getValue() == $this->trueValue) {
            $checked = 'checked';
        }

        $element = new HtmlBuilder('input');
        $element->attr('type', 'checkbox')
            ->attr('name', $this->getName())
            ->attr('checked', $checked)
            ->attr('value', $this->trueValue);

        if ($this->isDisabled()) {
            $element->attr('disabled', true);
        }

        $tooltip = "";
        if (empty($this->getTooltip()) == false) {
            $tooltip = " " . $this->getTooltip();
            $this->setTooltip("");
        }
        // hidden for submission check
        $hidden = new HtmlBuilder('input');
        $hidden->attr('type', 'hidden')
            ->attr('name', $this->getName() . "_submitted")
            ->attr('value', 'yes');

        return $element->render() . $tooltip . $hidden->render();
    }
}
