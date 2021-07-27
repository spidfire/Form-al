<?php

namespace FormAl\Elements;

use FormAl\Utilities\HtmlBuilder;

/**
 * Class MultiSelect
 *
 * @package FormAl\Elements
 */
class MultiSelect extends Input
{
    /** @var array */
    public $options = [];
    /** @var string */
    public $trueValue = '1';
    /** @var string */
    public $falseValue = '0';

    /**
     * @param array $options
     *
     * @return $this
     */
    public function options($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @return array
     */
    public function getValue()
    {
        $submit = $this->getSubmitValue();
        if (count($submit) > 0) {
            return array_keys($submit);
        }
        if (array_key_exists($this->getName() . "_submitted", $_POST)) {
            return [];
        }
        if (is_array($this->value)) {
            return array_values($this->value);
        }
        return [];
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        $element = new HtmlBuilder('div');
        $element->attr('name', $this->getName());

        $this->optGroups($element, $this->options);

        $hidden = new HtmlBuilder('input');
        $hidden->attr('type', 'hidden')
            ->attr('name', $this->getName() . "_submitted")
            ->attr('value', 'yes');

        return $element->render() . $hidden->render();
    }

    /**
     * @param HtmlBuilder $builder
     * @param array       $data
     */
    public function optGroups(HtmlBuilder $builder, $data)
    {
        $values = $this->getValue();
        foreach ($data as $key => $value) {
            $div = $builder->add('div');
            $label = $div->add('label');
            $label->add('input')
                ->attr('type', "checkbox")
                ->attr('checked', in_array($key, $values) ? "checked" : null)
                ->attr('value', "true")
                ->attr('name', $this->getName() . "[" . $key . "]");

            if ($this->isDisabled()) {
                $label->attr('disabled', 'disabled');
            }

            $label->addText($value);
        }
    }
}
