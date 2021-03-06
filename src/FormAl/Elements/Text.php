<?php

namespace FormAl\Elements;

use FormAl\ElementBase;

/**
 * Class Text
 *
 * @package FormAl\Elements
 */
class Text extends ElementBase
{
    /** @var string */
    public $value = null;
    /** @var bool */
    public $fullWidth = true;
    /** @var bool */
    public $markForExport = false;
    /** @var string */
    public $text = "You need to set this text with using ->setText()";

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
     * @param string $text
     *
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;
        
        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        return $this->text;
    }


    /**
     * @param array $options
     */
    public function setOptions($options) {
        $this->setText($options["setText"]);
    }

    /**
     * @return array
     */
    public function getOptions() {
        $options = [];
        $options['setText'] = $this->text;
        return $options;
    }
}
