<?php

namespace FormAl\Elements;

use FormAl\ElementBase;
use FormAl\FormAlAbstract;
use FormAl\Utilities\HtmlBuilder;
// TODO: Use correct storage server
use StorageServer;

/**
 * Class IconUpload
 *
 * @package FormAl\Elements
 */
class IconUpload extends Input
{
    /** @var ElementBase[] */
    public $extendFields = [];

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        if (preg_match("/md-.*/", $value)) {
            $this->value = "materialdesign";
            $this->extendFields['materialdesign']->setValue($value);
        } else {
            $this->value = "typeimage";
            $this->extendFields['imageupload']->setValue($value);
        }

        return $this;
    }

    /**
     * @param string         $name
     * @param FormAlAbstract $formal
     */
    public function __construct($name, FormAlAbstract $formal)
    {
        $this->extendFields['imageupload'] = new ImageUploadToServer(
            'imageupload',
            $formal
        );
        $this->extendFields['materialdesign'] = new FaIconPicker(
            'materialdesign',
            $formal
        );
        parent::__construct($name, $formal);
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        $icondetails = $this->getValueIntern();
        if ($icondetails['selected'] == "typeimage") {
            return $icondetails['imageupload'];
        } else {
            if ($icondetails['selected'] == "materialdesign") {
                return $icondetails['materialdesign'];
            }
        }

        return null;
    }

    /**
     * @return array
     */
    public function getValueIntern()
    {
        $out = [];
        foreach ($this->extendFields as $key => $value) {
            $out[$key] = $value->getValue();
        }
        $out['selected'] = (isset($_POST[$this->getName()]))
            ? $_POST[$this->getName()] : $this->value;

        return $out;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function render()
    {
        $pageVars = [];
        $element = new HtmlBuilder('div');
        $select = $element->add('select')
            ->attr('class', 'form-control imgtype')
            ->attr('name', $this->getName())
            ->attr('onchange', 'changeImageSelect(this)');
        $values = $this->getValueIntern();
        $pageVars['menu'] = $values;
        $options = [
            'materialdesign' => 'Icon selecteren uit lijst',
            'typeimage'      => 'Afbeelding uploaden als icon',
        ];
        foreach ($options as $key => $value) {
            $select->add('option')
                ->attr('value', $key)
                ->attr(
                    'selected',
                    ($key == $values['selected'] ? 'selected' : null)
                )
                ->addText($value);

        }

        $element->addHtml('<br>');

        $element->addHtml(
            '
            <script type="text/javascript">
                $(document).ready(function() {
                $(".materialdesigndiv").show();
                    $(".imagediv").hide();
                });

                function changeImageSelect(select) {
                    var value = select.value;
                if (value == "typeimage") {
                        $(".imagediv").show();
                        $(".materialdesigndiv").hide();
                    } else {
                        $(".imagediv").hide();
                        $(".materialdesigndiv").show();
                    }
                }

                function changeBorderColor(input) {
                    input.style.borderColor = input.value;
                }
                $(function(){
                    var value = "' . $values['selected'] . '";
                if (value == "typeimage") {
                        $(".imagediv").show();
                        $(".materialdesigndiv").hide();
                    } else if (value == "materialdesign"){
                        $(".imagediv").hide();
                        $(".materialdesigndiv").show();
                    } else {
                  $(".imagediv").hide();
                  $(".materialdesigndiv").show();
                }

                })

            </script>
            <div class="imagediv">
            ' . $this->extendFields['imageupload']->render() . '
            </div>
            <div class="materialdesigndiv">
            ' . $this->extendFields['materialdesign']->render() . '
            </div>
            '
        );

        return $element->render();
    }

    /**
     * @param $file
     *
     * @return array|string
     */
    public function verifyFile($file)
    {
        $var = StorageServer::storePicture($file);

        return $var;
    }
}
