<?php

namespace FormAl\Elements;

use FormAl\ElementBase;
use FormAl\Utilities\HtmlBuilder;

/**
 * Class Submit
 *
 * @package FormAl\Elements
 */
class Submit extends ElementBase
{
    /** @var string */
    public $value = null;
    /** @var bool */
    public $markForExport = false;

    private $canBeUsedMultipleTimes = false;
    private $reuseDelay = 0;

    public function allowMultipleTimes(int $msDelay = 3000)
    {
        $this->canBeUsedMultipleTimes = true;
        $this->reuseDelay = $msDelay;

        return $this;
    }

    /**
     * @return bool
     */
    public function isClicked()
    {
        $updateArray = $this->getFormAl()->updatedValues();
        $name = md5($this->getName());

        return isset($updateArray[$name]);
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        $onclick = "if(this.getAttribute('rel')=='submitted'){return false;};this.setAttribute('rel','submitted');";

        if ($this->canBeUsedMultipleTimes) {
            $onclick .= "var scope = this;setTimeout(function(){scope.removeAttribute('rel')}, " . $this->reuseDelay . ");";
        }

        $element = new HtmlBuilder('input.form-control.btn.btn-primary.formal-element');
        $element->attr('style', 'width:250px');
        $element->attr('onclick', $onclick);
        $element->attr('type', 'submit')
            ->attr('name', md5($this->getName()))
            ->attr('value', $this->getLabel());

        return $element->render();
    }
}
