<?php

namespace FormAl\Elements;

use FormAl\ElementBase;

/**
 * Class Title
 *
 * @package FormAl\Elements
 */
class Title extends ElementBase
{
    /** @var string */
    public $value = null;
    /** @var bool */
    public $fullWidth = true;
    /** @var bool */
    public $markForExport = false;
    /** @var string */
    public $text = "You need to set this title with using ->setText()";

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
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function render()
    {
        return "<h2>" . $this->text . "</h2>";
    }
}
