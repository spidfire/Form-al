<?php

namespace FormAl\Elements;

use FormAl\Utilities\HtmlBuilder;

/**
 * Class MultiInput
 *
 * @package FormAl\Elements
 */
class MultiInput extends Input
{
    /** @var int */
    public $emptyFields = 2;
    /** @var int */
    public $maxFields = 10;
    /** @var array */
    public $inputValues = [];
    /** @var string */
    public $inputType = "text";
    /** @var string */
    public $buttonText = "Voeg een veld toe";

    /**
     * @param int $emptyFields
     *
     * @return $this
     */
    public function setEmptyFields($emptyFields)
    {
        $this->emptyFields = $emptyFields;

        return $this;
    }

    /**
     * @param int $maxFields
     *
     * @return $this
     */
    public function setMaxFields($maxFields)
    {
        $this->maxFields = $maxFields;

        return $this;
    }

    /**
     * Override
     * Example of $value: {0: [34, "Yes"], 1: [35, "No"]}
     * Or regular ["Yes", "No"]
     *
     * @param array $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->inputValues = $value;

        return $this;
    }

    /**
     * @param string $text
     *
     * @return $this
     */
    public function setButtonText($text)
    {
        $this->buttonText = $text;

        return $this;
    }

    /**
     * @return array
     */
    public function getValue()
    {
        $submit = $this->getSubmitValue();
        if (!empty($submit)) {
            return $submit;
        }

        return $this->inputValues;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        $element = new HtmlBuilder('div');
        $uniquename = 'multiinput_' . md5($this->getName());

        $values = $this->getValue();

        $inputValuesSize = sizeof($values);
        $numberOfInputs = ($inputValuesSize > $this->emptyFields
            ? $inputValuesSize : $this->emptyFields);

        $div = $element->add('div')
            ->attr('id', $uniquename . '_multiinput');

        $inputStyle = 'float: left; margin-left; margin-bottom: 15px;';
        $buttonStyle = 'margin-left: 15px; position: relative; top: +10px;';

        $updatedEmptyFields = false;

        $values = array_values($values);
        for ($curInput = 0; $curInput < $numberOfInputs; $curInput++) {
            $valueItem = "";
            if (isset($values[$curInput])) {
                $valueItem = $values[$curInput];
            }

            $inputDiv = $div->add('div')
                ->attr('style', 'overflow: auto;');

            $elementId = "";
            $value = $valueItem;
            if (is_array($valueItem)) {
                $elementId = "id_" . $valueItem[0];
                $value = $valueItem[1];

                // Yeah yeah I know. Bad way to do this. Please fix it if you can.
                if (!$updatedEmptyFields) {
                    $this->setEmptyFields(0);
                }
            }

            $inputDiv->add('input.form-control')
                ->attr('type', $this->inputType)
                ->attr('name', $this->getName() . '[' . $elementId . ']')
                //->attr('name', $this->getName() . '[]')
                ->attr('style', $inputStyle)
                ->attr('value', $value);

            if ($curInput >= $this->emptyFields) {
                $removeButton = $inputDiv->add('a')
                    ->attr('href', "#")
                    ->attr('class', "remove_field")
                    ->attr('style', $buttonStyle);

                $removeButton->add('i')
                    ->attr('class', 'fa fa-times');
            }
        }

        $addButton = $element->add('a')
            ->attr('type', 'button')
            ->attr('class', 'btn btn-'.$uniquename)
            ->attr('onclick', $uniquename . '_add({})')
            ->attr('style', 'margin-left: 15px; height: 34px;');

        $addButton->add('i')
            ->attr('class', 'fa fa-plus')
            ->addHtml('&nbsp;');

        $addButton->addHtml($this->buttonText);

        $element->add('script')
            ->addHtml(
                '
                var max_fields = ' . $this->maxFields . ';
                var num_fields = ' . $numberOfInputs . ';
                var wrapper = ' . $uniquename . '_multiinput;

                function ' . $uniquename . '_add() {
                    if (num_fields < max_fields) {
                        num_fields++;

                        var input = "<input class=\"form-control\" style=\"'
                . $inputStyle . '\" type=\"' . $this->inputType . '\" name=\"'
                . $this->getName() . '[]\" />";
                        
                        var remove_field = "<a href=\"#\" style=\"'
                . $buttonStyle . '\" class=\"remove_field\" ><i class=\"fa fa-times\"</i></a>";

                        $(wrapper).append("<div style=\"overflow: auto;\">" + input + remove_field + "</div>");
                    }
                    if (num_fields >= max_fields) {
                        $(".btn-'.$uniquename.'").hide();
                    }
                }
                $(wrapper).on("click", ".remove_field", function(e) {
                    e.preventDefault();

                    $(this).parent("div").remove();

                    num_fields--;
                    if (num_fields != max_fields) {
                        $(".btn-'.$uniquename.'").show();
                    }
                })

                if (num_fields >= max_fields) {
                    $(".btn-'.$uniquename.'").hide();
                }
            '
            );

        return $element->render();
    }
}
