<?php
namespace FormAl\Elements;

use FormAl\ElementBase;
use FormAl\Utilities\HtmlBuilder;

/**
 * Class Button
 *
 * @package FormAl\Elements
 */
class Button extends ElementBase
{
    /** @var string */
    private $labelname = "";
    /** @var string */
    private $location = "";
    /** @var string */
    public $text = "";

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
     * @param string $location
     *
     * @return $this
     */
    public function location($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        $element = new HtmlBuilder('a.form-control.btn.btn-default');
        $element->attr('name', md5($this->getName()))
            ->attr('href', $this->location)
            ->attr('style', "max-width: 400px;")
            ->addText($this->text);

        if ($this->isDisabled()) {
            $element->attr('disabled', true);
        }

        return $element->render();
    }
}
