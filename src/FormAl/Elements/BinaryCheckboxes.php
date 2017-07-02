<?php

namespace FormAl\Elements;

use FormAl\Utilities\HtmlBuilder;

/**
 * Class BinaryCheckboxes
 *
 * @package FormAl\Elements
 */
class BinaryCheckboxes extends Input
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
     * @return int|null|string
     */
    public function getValue()
    {
        $submit = $this->getSubmitValue();
        if ($submit === null) {
            return $this->value;
        }
        $byte = 0;
        foreach (array_keys($this->options) as $bit) {
            if (isset($submit[$bit])) {
                $byte |= 1 << $bit;
            }
        }

        return $byte;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        $checked = null;
        $binaryCheckboxes = new HtmlBuilder('div.binarycontainer');

        // this is to allow none of the files to be set
        $binaryCheckboxes->add('input')
            ->attr('type', 'hidden')
            ->attr('name', $this->getName() . "[-1]")
            ->attr('value', 'nothing');


        foreach ($this->options as $bit => $text) {
            $checked = (($this->getValue() & (1 << $bit)) > 0) ? "checked"
                : null;
            $cont = $binaryCheckboxes
                ->add('div')
                ->attr(
                    'style',
                    'display: inline-block; margin-right: 20px;'
                );
            $label = $cont->add('label');
            $label->add('input')
                ->attr('type', 'checkbox')
                ->attr('name', $this->getName() . "[" . $bit . "]")
                ->attr('checked', $checked);
            $label->addHtml($text);
        }

        return $binaryCheckboxes->render();
    }
}
