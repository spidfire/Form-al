<?php

namespace FormAl\Elements;

use FormAl\ElementBase;
use FormAl\Utilities\HtmlBuilder;
use FormAl\Validators\MinLength;

/**
 * Class Datepicker
 *
 * @package FormAl\Elements
 */
class Datepicker extends ElementBase
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
            ->attr('id', $this->getName());

        if($this->isDisabled()){
            $element->attr('disabled', 'disabled');
        }

        $dateStr = $this->getValue();
        if ($dateStr instanceof \DateTime) {
            $dateStr = $dateStr->format("d-m-Y H:i");
        }
        $element->attr('value', $dateStr);
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
                    timepicker:true,
                    lang:'".$lang."',
                    format:'d-m-Y H:i',
                });
                
            if (moment && typeof moment === 'function') {
                $('#" . $this->getName() . "').change(function () {
                    var object = $('#" . $this->getName() . "');
                    var alternativeFormat = 'DD-MM-YYYY HH.mm';
                    var value = object.val();
                    var start = moment(value, alternativeFormat);
                    endString = start.format('DD-MM-YYYY HH:mm');

                    if(value == start.format(alternativeFormat)) {
                        object.val(endString);
                    }

                    var alternativeFormat = 'DD.MM.YYYY HH:mm';
                    var value = object.val();
                    var start = moment(value, alternativeFormat);
                    endString = start.format('DD-MM-YYYY HH:mm');

                    if(value == start.format(alternativeFormat)) {
                        object.val(endString);
                    }

                });
            }
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
