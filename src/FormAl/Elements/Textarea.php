<?php

namespace FormAl\Elements;

use FormAl\Utilities\HtmlBuilder;

/**
 * Class Textarea
 *
 * @package FormAl\Elements
 */
class Textarea extends Input
{
    /** @var int */
    public $cols = 50;
    /** @var int */
    public $rows = 12;
    /** @var bool */
    public $fancy = false;

    /**
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        $div = new HtmlBuilder('div');
        $element = $div->add('textarea.form-control');
        $element->attr('name', $this->getName())
            ->attr('cols', $this->cols)
            ->attr('rows', $this->rows)
            ->addText($this->getValue());
            
        if ($this->isDisabled()) {
            $element->attr('disabled', 'disabled');
        }
        
        if ($this->fancy) {
            return $element->render()
            . '<script type="text/javascript">
            var a = CKEDITOR.replace("'. $this->getName() .'");

            a.on("instanceReady",function() {
              // insert code to run after editor is ready
              $(".cke_wysiwyg_frame").css("display","")
            });

            </script>';
        }

        return $element->render();
    }

    /**
     * @param bool $bool
     *
     * @return $this
     */
    public function setFancy($bool)
    {
        $this->fancy = $bool;

        return $this;
    }

    /**
     * @return bool $bool
     */
    public function getFancy()
    {
        return $this->fancy;
    }

    /**
     * @param array $options
     */
    public function setOptions($options){
        if (isset($options['setFancy'])) {
            $this->setFancy($options['setFancy']);
        }
    }

    /**
     * @return array
     */
    public function getOptions() {
        $options = [];
        $options['setFancy'] = $this->getFancy();
        return $options;
    }
}
