<?php

namespace FormAl\Elements;

use FormAl\Utilities\HtmlBuilder;

/**
 * Class Select
 *
 * @package FormAl\Elements
 */
class Select extends Input
{
    /** @var array */
    public $options = [];

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
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        $element = new HtmlBuilder('select.form-control');
        $element->attr('name', $this->getName());

        if ($this->isDisabled()) {
            $element->attr('disabled', 'disabled');
        }

        $this->optGroups($element, $this->options);

        return $element->render();
    }

    /**
     * @param HtmlBuilder $builder
     * @param array       $data
     */
    public function optGroups(HtmlBuilder $builder, $data)
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $sub = $builder->add('optgroup')
                    ->attr('label', $key);
                $this->optGroups($sub, $value);
            } else {
                $builder->add('option')
                    ->attr('value', $key)
                    ->attr(
                        'selected',
                        ($key == $this->getValue() ? 'selected' : null)
                    )
                    ->addText($value);
            }
        }
    }
}
