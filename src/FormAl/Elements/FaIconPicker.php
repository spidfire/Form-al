<?php

namespace FormAl\Elements;

use FormAl\ElementBase;
use FormAl\Utilities\HtmlBuilder;
use FormAl\Validators\MinLength;

/**
 * Class FaIconPicker
 *
 * @package FormAl\Elements
 */
class FaIconPicker extends ElementBase
{
    /** @var string */
    public $type = "text";
    /** @var string */
    private $labelname = "";

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
        $element = new HtmlBuilder('div');
        $element->attr('type', $this->type)
            ->attr('id', $this->getName())
            ->attr('value', $this->getValue())
            ->attr('class', "input-group iconpicker-container");

        $oldIcon = '';
        if (!empty($this->getValue())) {
            $oldIcon = $this->getValue();
        }
        if (!empty($oldIcon) && stristr($this->getValue(), 'fa-')
            && stristr($this->getValue(), 'fa ') == false
        ) {
            $oldIcon = 'fa ' . $oldIcon;
        }

        $element->addHtml(
            '
            <button style="background: #29b9b5;" class="btn btn-default" id="target" role="" name="'
            . $this->getName() .
            '" data-icon="' . $oldIcon . '"></button>

            <script type="application/javascript">
            $(\'#target\').iconpicker({
                align: \'center\', // Only in div tag
                arrowClass: \'btn-danger\',
                arrowPrevIconClass: \'cl-icon-arrow-left-gradient\',
                arrowNextIconClass: \'cl-icon-arrow-right-gradient\',
                cols: 8,
                footer: true,
                header: true,
                iconset: \'fontawesome\',
                labelHeader: \'{0} of {1} pages\',
                labelFooter: \'{0} - {1} of {2} icons\',
                placement: \'bottom\', // Only in button tag
                rows: 4,
                search: true,
                searchText: \'Search\',
                selectedClass: \'btn-success\',
                unselectedClass: \'\'
            });
            </script>
'
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
