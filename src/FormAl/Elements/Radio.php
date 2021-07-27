<?php

namespace FormAl\Elements;

use FormAl\Utilities\HtmlBuilder;

/**
 * Class Radio
 *
 * @package FormAl\Elements
 */
class Radio extends Input
{
    /** @var array */
    public $options = [];

    /**
     * @param array $options
     */
    public function options($options)
    {
        $this->options = $options;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        $element = new HtmlBuilder('div');
        $sel = $element->add('ul');

        $this->optGroups($sel, $this->options);

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
                $list = $builder->add('li');
                $list->addText($key);
                $sub = $list->add('ul');
                $this->optGroups($sub, $value);
            } else {
                $builder->add('li')
                    ->add('label')
                    ->add('input')
                    ->attr('type', 'radio')
                    ->attr('name', $this->getName())
                    ->attr(
                        'checked',
                        ($key == $this->getValue() ? 'selected' : null)
                    )
                    ->attr('value', $key)
                    ->addText($value);
                
                if ($this->isDisabled()) {
                    $builder->attr('disabled', 'disabled');
                }
            }
        }
    }
}
