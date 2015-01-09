<?php

namespace spidfire\Elements;
use spidfire\Validators\MinLength;
use spidfire\ElementBase;
use spidfire\Utilities\HtmlBuilder;

class Hidden extends Input{
    var $type = "hidden";

    private $labelname = "";
    function label($text){
        $this->labelname = $text;
        return $this;
    }

    function getLabel(){
        return $this->labelname;
    }

    function render(){
        $e = new HtmlBuilder('input.form-control');
        $e->attr('type',$this->type)
            ->attr('name', $this->getName())
            ->attr('value', $this->getValue());
        return $e->render();
    }

    function min($length){
        $this->addValidator(new MinLength($length));
        return $this;
    }
}