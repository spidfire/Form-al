<?php

namespace FormAl\Elements;

use FormAl\Utilities\HtmlBuilder;

/**
 * Class Chosen
 *
 * @package FormAl\Elements
 */
class Chosen extends Input
{
    /** @var array */
    public $options = [];
    /** @var array */
    private $selected = [];

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
     * @param array $selected
     *
     * @return $this
     */
    public function selected($selected)
    {
        $this->selected = $selected;

        return $this;
    }

    /**+
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        $element = new HtmlBuilder('select.form-control');
        $element->attr('name', $this->getName() . "[]");
        $element->attr('multiple', 'multiple');
        $element->attr('class', 'chosen-select form-control');

        if ($this->isDisabled()) {
            $element->attr('disabled', 'disabled');
        }

        $this->optGroups($element, $this->options);

        return $element->render() . "<script type='text/javascript'>
        $(\".chosen-select\").chosen();
        </script>";
    }

    /**
     * @param HtmlBuilder $element
     * @param array       $data
     */
    public function optGroups(HtmlBuilder $element, $data)
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $sub = $element->add('optgroup')
                    ->attr('label', $key);
                $this->optGroups($sub, $value);
            } else {
                $element->add('option')
                    ->attr('value', $key)
                    ->attr(
                        'selected',
                        in_array($key, $this->selected) ? "checked" : null
                    )
                    ->addText($value);
            }
        }
    }
}
