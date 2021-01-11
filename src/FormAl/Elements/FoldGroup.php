<?php

namespace FormAl\Elements;

use FormAl\ElementBase;
use FormAl\FormAlAbstract;

/**
 * Class Input
 *
 * @package FormAl\Elements
 */
class FoldGroup extends ElementBase
{
    /** @var ElementBase[] */
    private $elements = [];
    /** @var string */
    private $labelname = "";

    /**
     * @param string         $name
     * @param FormAlAbstract $formal
     */
    public function __construct($name, FormAlAbstract $formal)
    {
        parent::__construct($name, $formal);
        $this->markForExport = false;
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
        // this class doesn't render itself
        return "";
    }

    /**
     * @param ElementBase $element
     *
     * @return $this
     */
    public function addElement(ElementBase $element)
    {
        $element->setFolded(true);
        $this->elements[] = $element;

        return $this;
    }

    /**
     * @param array $elements
     *
     * @return $this
     */
    public function addElements(array $elements)
    {
        foreach ($elements as $el) {
            $this->addElement($el);
        }

        return $this;
    }

    /**
     * @return \FormAl\ElementBase[]
     */
    public function getElements()
    {
        return $this->elements;
    }
}
