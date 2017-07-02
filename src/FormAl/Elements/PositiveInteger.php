<?php

namespace FormAl\Elements;

use FormAl\FormAlAbstract;
use FormAl\Utilities\HtmlBuilder;

/**
 * Class PositiveInteger
 *
 * @package FormAl\Elements
 */
class PositiveInteger extends Integer
{
    /**
     * @param string         $name
     * @param FormAlAbstract $formal
     */
    public function __construct($name, FormAlAbstract $formal)
    {
        parent::__construct($name, $formal);
        $this->min('1');
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        $element = new HtmlBuilder('input.form-control');
        $element->attr('type', $this->type)
            ->attr('name', $this->getName())
            ->attr('min', '1')
            ->attr('value', $this->getValue());

        return $element->render();
    }
}
