<?php

namespace FormAl\Elements;

use FormAl\ElementBase;
use FormAl\FormAlAbstract;
use FormAl\Utilities\HtmlBuilder;
use FormAl\Validators\MinLength;
use FormAl\Validators\ValidURL;

/**
 * Class URL
 *
 * @package FormAl\Elements
 */
class URL extends ElementBase
{
    /** @var string */
    public $type = "text";
    /** @var string */
    private $labelname = "";

    /**
     * @param string         $name
     * @param FormAlAbstract $formal
     */
    public function __construct($name, FormAlAbstract $formal)
    {
        parent::__construct($name, $formal);
        $this->addValidator(new ValidURL());
    }

    /**
     * @param string $text
     *
     * @return $this
     */
    public function label($text)
    {
        $this->labelname = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->labelname;
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
            ->attr('value', $this->getValue());

        return $element->render();
    }

    /**
     * @param int $length
     *
     * @return $this
     */
    public function min($length)
    {
        $this->addValidator(new MinLength($length));

        return $this;
    }
}
