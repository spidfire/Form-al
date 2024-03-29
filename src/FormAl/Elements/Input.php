<?php

namespace FormAl\Elements;

use FormAl\ElementBase;
use FormAl\Utilities\HtmlBuilder;
use FormAl\Validators\MinLength;
use FormAl\Validators\MaxLength;

/**
 * Class Input
 *
 * @package FormAl\Elements
 */
class Input extends ElementBase
{
    /** @var string */
    public $type = "text";
    /** @var string */
    private $labelname = "";

    /** @var int */
    private $maxLength = null;
    /** @var bool */
    private $isRequired = false;

    const DEFAULT_MAX_LENGTH = 128;

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
        if (!empty($this->maxLength)) {
            $element->attr('maxlength', $this->maxLength);
        }

        if ($this->isDisabled()) {
            $element->attr('disabled', 'disabled');
        }

        if (!$this->hasAutoFill) {
            $element->attr('readonly', 'true')
                ->attr('onfocus', 'javascript:this.removeAttribute(\'readonly\');')
                ->attr(
                    'onmouseover', 'javascript:this.removeAttribute(\'readonly\');'
                )
                ->attr('autocomplete', 'off');
        }

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

    /**
     * Add validator for setting a maximum on the string length.
     *
     * @param int $length
     *
     * @return $this
     */
    public function max($length)
    {
        if (empty($length)) {
            $length = self::DEFAULT_MAX_LENGTH;
        }

        $this->addValidator(new MaxLength($length));

        $this->maxLength = $length;

        return $this;
    }
}
