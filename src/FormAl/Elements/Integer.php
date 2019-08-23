<?php

namespace FormAl\Elements;

use FormAl\ElementBase;
use FormAl\Utilities\HtmlBuilder;
use FormAl\Validators\MinIntValue;

/**
 * Class Integer
 *
 * @package FormAl\Elements
 */
class Integer extends ElementBase
{
    /** @var string */
    public $type = "number";
    /** @var string */
    private $labelname = "";
    /** @var bool */
    private $isRequired = false;

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
        if ($this->isRequired()) {
            return $this->labelname . '*';
        } else {
            return $this->labelname;
        }
    }

    /**
     * @return bool
     */
    public function isRequired()
    {
        return $this->isRequired;
    }

    /**
     * @param bool $isRequired
     */
    public function setIsRequired($isRequired = true)
    {
        $this->isRequired = $isRequired;
    }

    public function notNull()
    {
        $this->setIsRequired();

        return parent::notNull();
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
        $this->addValidator(new MinIntValue($length));

        return $this;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return $this->getValue() === null;
    }
}
