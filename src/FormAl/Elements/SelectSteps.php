<?php

namespace FormAl\Elements;

use FormAl\Utilities\HtmlBuilder;

/**
 * Class SelectSteps
 *
 * @package FormAl\Elements
 */
class SelectSteps extends Input
{
    /** @var array */
    public $options = [];
    /** @var bool */
    public $nullable = true;

    /**
     * @param array $options
     *
     * @return $this
     */
    public function options($options)
    {
        $this->options = $options;
        if ($this->nullable) {
            $this->options = array_merge($this->options, ["" => trans("None")]);
        }
        
        return $this;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        $element = new HtmlBuilder('div.select-row');

        $element->addHtml(
            '<script>
            function addStep(selected, value, choice){
                if (value=="") {
                    $(".selectstep").hide();
                    $(".selectdepth-0").show();
                    $("#' . $this->getName() . '").val(value);
                    return;
                }
                var select = $(".selectedstep-" + selected);
                if(select.length == 0){
                    $("#' . $this->getName() . '").val(value);

                    var selectclasses = select.closest(".selectstep").attr("class");
                    $("#' . $this->getName() . '-text").show().html("<i class=\'fa fa-check\'></i> Je hebt " + choice + " gekozen");
                    var selectdepth = selectclasses.substr(selectclasses.indexOf("selectdepth-") + 12, 1);
                    for(var i = selectdepth; i < 10; i++){
                        
                        $(".selectdepth-" + i).hide();
                    }
                } else {
                    $("#' . $this->getName() . '").val();
                    $("#' . $this->getName() . '-text").hide();
                }
                select.each(function(){
                    var classes = $(this).attr("class");
                    var depth = classes.substr(classes.indexOf("selectdepth-") + 12, 1);
                    
                    for(var i = depth; i < 10; i++){
                        
                        $(".selectdepth-" + i).hide();
                    }

                    $(this).show();

                    classes = $(this).find(":selected").attr("class");
                    var count = classes.indexOf("selectstep-") + 11;
                    var sendvalue = $(this).find(":selected").val();
                    var choice = $(this).find(":selected").html();
                    var row = classes.substr(count);
                    addStep(row, sendvalue, choice);
                })
            }
            $(".select-row").on("change mouseup", ".selectstep", function(){
             
                var classes = $(this).find(":selected").attr("class");
                var count = classes.indexOf("selectstep-") + 11;
                var sendvalue = $(this).find(":selected").val();
                var choice = $(this).find(":selected").html();
                var row = classes.substr(count);
                addStep(row, sendvalue, choice);
            })
        </script>'
        );
        //$e->attr('name', $this->getName());

        $this->makeSelect($element, $this->options, $this->getValue(), false);
        $element->addHtml(
            '<label id="' . $this->getName()
            . '-text" style="display: none;" ></label><input type="hidden" id="'
            . $this->getName() . '" name="' . $this->getName() . '" value="'
            . $this->getValue() . '"></input>'
        );

        return $element->render();
    }

    /**
     * @param HtmlBuilder $builder
     * @param array       $data
     * @param string      $default
     * @param boolean     $hidden
     * @param int         $depth
     * @param string      $name
     *
     * @return bool|void
     */
    public function makeSelect(
        HtmlBuilder $builder,
        $data,
        $default,
        $hidden,
        $depth = 0,
        $name = ""
    ) {
        if ($depth > 5) {
            $this->error("Data problem", "There is a infinite amount of data");

            return null;
        }
        $selected = false;

        $select = $builder->add(
            "select.form-control selectstep selectdepth-" . $depth . " " . $name
            . " "
        );
        $label = $select->add('optgroup')
            ->attr("label", "Selecteer een optie");
        $options = [];
        foreach ($data as $key => $value) {
            $option = $label->add('option.selectstep-' . $this->clean($key))
                ->attr('value', $key);

            if (is_array($value)) {
                $option->addText($key);
            } else {
                if ($key == $default) {
                    $option->attr('selected', true);
                    $hidden = false;
                    $selected = true;
                }
                $option->addText($value);
            }
            $options[$key] = $option;
        }

        $tempdepth = $depth + 1;
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $arr = $value;
                $optionselected = $this->makeSelect(
                    $builder,
                    $arr,
                    $default,
                    true,
                    $tempdepth,
                    "selectedstep-" . $this->clean($key)
                );
                if ($optionselected) {
                    /** @var HtmlBuilder $option */
                    $option = $options[$key];
                    $option->attr('selected', true);
                    $hidden = false;
                }
            }
        }
        if ($hidden) {
            $hidden = "none";
        } else {
            $hidden = "block";
        }
        $select->attr("style", "margin-bottom: 5px;display:" . $hidden);

        return $selected;
    }

    /**
     * @param string $string
     *
     * @return mixed
     */
    public function clean($string)
    {
        $string = str_replace(
            ' ',
            '-',
            $string
        ); // Replaces all spaces with hyphens.
        return preg_replace(
            '/[^A-Za-z0-9\-]/',
            '',
            $string
        ); // Removes special chars.
    }

    /**
     * @return $this
     */
    public function notNull()
    {
        $this->nullable = false;

        return parent::notNull();
    }
}
