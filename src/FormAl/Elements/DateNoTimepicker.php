<?php

namespace FormAl\Elements;

use FormAl\ElementBase;
use FormAl\Utilities\HtmlBuilder;
use FormAl\Validators\MinLength;

/**
 * Class DateNoTimepicker
 *
 * @package FormAl\Elements
 */
class DateNoTimepicker extends ElementBase
{
    /** @var string */
    public $type = "text";
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
            ->attr('id', $this->getName())
            ->attr('value', $this->getValue());
        //->attr('style', 'height: 32px; width: 400px;');

        if (isset($_COOKIE['lang'])) {
            $lang = explode('_', $_COOKIE['lang']);
            $lang = $lang[0];
        } else {
            $lang = 'en';
        }
        $element->addHtml(
            "<script>$('#" . $this->getName()
            . "').datetimepicker({
                    scrollMonth:false,
                    scrollTime:false,
                    scrollInput:false,
                    timepicker:false,
                    lang:'".$lang."',
                    format:'d-m-Y'
                });
            </script>"
        );

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
