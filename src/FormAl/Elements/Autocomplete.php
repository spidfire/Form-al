<?php

namespace FormAl\Elements;

use FormAl\Utilities\HtmlBuilder;

/**
 * Class Autocomplete
 *
 * @package FormAl\Elements
 */
class Autocomplete extends Input
{
    /** @var array */
    public $options = [];
    /** @var int */
    public $emptyfields = 4;
    /** @var string */
    public $placeholder = "Zoek";
    /** @var string */
    public $addButtonText = "Toevoegen";
    /** @var array */
    public $extra_fields = [];
    /** @var string Message shown when the user tries to add a duplicate to the selected list. */
    public $duplicateMessaeg = "";

    /**
     * @param array $options
     *
     * @return $this
     */
    public function options($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @param string $placeholder
     *
     * @return $this
     */
    public function setPlaceholder($placeholder)
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * @param string $name
     * @param string $placeholder
     * @param int    $maxLength
     *
     * @return $this
     */
    public function addField($name, $placeholder, $maxLength = 128)
    {
        $this->extra_fields[] = [
            "name"        => $name,
            "placeholder" => $placeholder,
            "maxlength"   => $maxLength,
        ];

        return $this;
    }

    /**
     * Message to show when the user tries to add an item to the list of selected
     * items, when it is already in the list of selected items.
     * When empty, adding duplicates is allowed.
     * Default: empty
     *
     * @param string $duplicateMessage
     *
     * @return $this
     */
    public function setDuplicateMessage($duplicateMessage)
    {
        $this->duplicateMessage = $duplicateMessage;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        $submit = $this->getSubmitValue();
        $update = $this->getFormAl()->updatedValues();
        $isSubmitted = array_key_exists(
            $this->getName() . "_submitted",
            $update
        );

        if (is_null($submit)) {
            if ($isSubmitted == true) {
                return [];
            } else {
                return $this->value;
            }
        } else {
            return $submit;
        }
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        $element = new HtmlBuilder('div');
        $uniquename = 'autocompete_' . md5($this->getName());
        $items = is_array($this->getValue()) ? $this->getValue() : [];
        $element->add('ol')
            ->attr('class', 'autocompleteholder')
            ->attr('style', 'margin-bottom:0px;')
            ->attr('id', $uniquename . '_holder');
        $jsexec = [];
        foreach ($items as $value) {
            $name = "";
            if (isset($value['name']) && isset($this->options[$value['name']])) {
                $name = $this->options[$value['name']];
            }
            if (empty($name)) {
                $name = '"Onbekende naam: ' . $value['name'] . '"';
            }

            $name = htmlspecialchars($name);

            $jsexec[] = $uniquename . "add(\"" . $name . "\"," . json_encode($value)
                . ");";
        }

        $element->add('input.form-control.searchbox')
            ->attr('id', $uniquename . "_id")
            ->attr('style', 'margin-top: 10px')
            ->attr('type', $this->type)
            ->attr('placeholder', $this->placeholder)
            ->attr('autocomplete', 'off')
            ->attr('onkeyup', $uniquename . "(this.value)");
        $element->add('div')->attr('id', '' . $uniquename . '_autocompl');
        $element->add('noscript')->addText(
            "Sorry this function needs Javascript to work!"
        );
        $element->nl();

        $script = $element->add('script');

        $extraFieldData = "";

        // adds an field to the js
        if ($this->extra_fields) {
            foreach ($this->extra_fields as $field) {
                $extraFieldData
                    .= 'lihtml.append(" "); lihtml.append($("<input/>")
                        .attr({
                          "type": "text",
                          "class": "form-control",
                          "style": "width:40%; display:inline",
                          "name": "' . $this->getName() . '["+id_' . $uniquename
                    . '+"][' . $field['name'] . ']",
                          "placeholder": "' . $field['placeholder'] . '",
                          "value": value["' . $field['name'] . '"],
                          "maxlength": "' . $field['maxlength'] . '"
                        }));';
            }
        }

        $options = [];
        foreach ($this->options as $key => $value) {
            $options[$key] = htmlentities($value);
        }

        $addButtonText = $this->addButtonText;
        $name = $this->getName();
        $encodedOptions = json_encode($options);
        $jsExecString = implode("\n", $jsexec);

        $duplicateCheck = "";
        if (!empty($this->duplicateMessage)) {
            $duplicateCheck = "if ($.inArray(name, {$uniquename}_names) > -1) {
                    toastr.error('" . trans($this->duplicateMessage) . "');
                    return;
                }";
        }

        $script->addHtml(
            "var {$uniquename}_names = [];
            var {$uniquename}_items = {$encodedOptions};
            function {$uniquename}(search,index){
                var count = 0;
                var searchparts = search.toLowerCase().split(' ');
                var elm = jQuery('#{$uniquename}_autocompl');
                elm.html('');
                if(search.trim().length == 0) {
                    return;
                }

                for(var i in {$uniquename}_items) {
                    var v= {$uniquename}_items[i];
                    var partnotfound = true;
                    for(var p in searchparts) {
                        if(v.toLowerCase().indexOf(searchparts[p]) < 0) {
                            partnotfound = false
                        }
                    }
                    if(partnotfound == true){
                        var item = $('<li/>').css('list-style','none');
                        item.addClass('autoadd');
                        item.append(
                            $('<button/>').text('{$addButtonText}')
                            .addClass('btn').addClass('btn-primary')
                            .attr('id', 'but-' + count)
                            .attr('type','button').attr('title',v)
                            .attr('val',i).click(function () {
                                {$uniquename}add(
                                    $(this).attr('title'),
                                    {name:$(this).attr('val')}
                                );
                                elm.html('');
                                $('#{$uniquename}_id').val('');
                            })
                        );
                        item.append('&nbsp;&nbsp;');
                        item.append(v);
                        elm.append(item);
                        count++;
                    }

                    if(count > 10) {
                        break;
                    }
                }
                if (count == 0) {
                    elm.append('Geen resultaten');
                }
            }
            var  id_{$uniquename} = 0;
            function {$uniquename}add(name, value) {
                {$duplicateCheck}

                var lihtml = $('<li/>');

                lihtml.append(
                    $('<input/>').attr({
                        'type': 'hidden',
                        'name': '{$name}[' + id_{$uniquename} + '][name]',
                        'value': value['name']
                    })
                );
                lihtml.append('<div class=\'autocompletetextholder form-control\' style=\'display:inline-block; width:40%; border:none;\'>' + name + '</div>')
                     {$extraFieldData}

                var button = '<a name=\'xbut\' href=\'Javascript:void(0)\' '
                    + 'onclick=\'$(this).parent().remove()\' > X</a>';
                lihtml.append(button);

                lihtml = '<li>' + lihtml.html() + '</li>';
                $('#{$uniquename}_holder').html($('#{$uniquename}_holder').html() + lihtml);

                id_{$uniquename}++;

                {$uniquename}_names.push(name);
            }

            $(function () {
                {$jsExecString}
            });"
        );

        if (json_last_error() != JSON_ERROR_NONE) {
            throw new \Exception("JSON ERROR: " . json_last_error_msg(), 1);
        }

        // hidden for submission check
        $hidden = new HtmlBuilder('input');
        $hidden->attr('type', 'hidden')
            ->attr('name', $this->getName() . "_submitted")
            ->attr('value', 'yes');

        return $element->render() . $hidden->render();
    }

    /**
     * @param $dat
     *
     * @return array|string
     */
    public function utf8EncodeAll($dat)
    {
        if (is_string($dat)) {
            return utf8_encode($dat);
        }
        if (!is_array($dat)) {
            return $dat;
        }
        $ret = [];
        foreach ($dat as $i => $d) {
            $ret[$i] = $this->utf8EncodeAll($d);
        }

        return $ret;
    }

    /**
     * @inheritdoc
     */
    public function setOptions($array = [])
    {
        $this
            ->options($array)
            ->setPlaceholder(trans("Zoek naar leden"))
            ->addField("functie", trans("Functie"));
    }
}
