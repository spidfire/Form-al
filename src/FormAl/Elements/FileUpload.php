<?php

namespace FormAl\Elements;

use FormAl\Utilities\HtmlBuilder;
// TODO: Use correct storage server
use StorageServer;

/**
 * Class FileUpload
 *
 * @package FormAl\Elements
 */
class FileUpload extends Input
{
    public $publicPath = "images/";
    public $localPath = "images/";
    public $page = "";
    public $accept = "*/*";
    /** @var bool See documentation of setIsTemp. */
    private $isTemp = false;

    /** @var boolean Allow multiple file upload form elements.  */
    protected $allowMultiple = false;

    /**
     * SetIsTemp is the setter for the private isTemp class variable.
     * isTemp is used by getValue to determine if the uploaded file is temporary
     * and should therefore not be stored permanently on the server.
     *
     * @param bool $isTemp The new boolean value.
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setIsTemp($isTemp)
    {
        if (!is_bool($isTemp)) {
            throw new \InvalidArgumentException(
                "type of parameter isTemp is expected to be bool"
            );
        }

        $this->isTemp = $isTemp;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Set to true to draw a button which on click creates more file upload form
     * elements to use.
     *
     * @param boolean $allowMultiple New value to set.
     *
     * @return this
     */
    public function setAllowMultiple($allowMultiple)
    {
        $this->allowMultiple = $allowMultiple;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getValue()
    {
        $return = [];

        if (array_key_exists($this->getName() . "_checkbox", $_POST)) {
            $post = $_POST[$this->getName() . "_checkbox"];

            $json = $this->value;
            $jsonArr = json_decode($json, true);

            foreach (array_keys($post) as $key) {
                for ($i = 0; $i < count($jsonArr); $i++) {
                    if ($key == $jsonArr[$i]["name"]) {
                        $return[] = $jsonArr[$i];
                    }
                }
            }
        }

        if (!empty($_FILES)
            && array_key_exists($this->getName(), $_FILES)
        ) {
            $fileCount = count($_FILES[$this->getName()]["name"]);

            for ($i = 0; $i < $fileCount; $i++) {
                if ($this->isTemp) {
                    $return[] = [
                        "name" => urlencode(
                            $_FILES[$this->getName()]["name"][$i]
                        ),
                        "tmp_name" => $_FILES[$this->getName()]["tmp_name"][$i],
                    ];
                } else {
                    $tmpFile = [];
                    $tmpFile["name"] = urlencode(
                        $_FILES[$this->getName()]["name"][$i]
                    );
                    $tmpFile["type"] = $_FILES[$this->getName()]["type"][$i];
                    $tmpFile["tmp_name"]
                        = $_FILES[$this->getName()]["tmp_name"][$i];
                    $tmpFile["error"]
                        = $_FILES[$this->getName()]["error"][$i];
                    $tmpFile["size"] = $_FILES[$this->getName()]["size"][$i];

                    if (!empty($tmpFile["tmp_name"])) {
                        $arr = $this->storeFile($tmpFile);
                        if (!empty($arr)) {
                            $return[] = $arr;
                        }
                    }
                }
            }

            return json_encode($return);
        }

        return $this->value;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        $inputStyle = "margin-bottom: 15px;";
        $element = new HtmlBuilder('div');

        $wrapper = $element->add('div')
            ->attr('id', $this->getName() . "_wrapper");

        $wrapper->add('input.form-control')
            ->attr('type', 'file')
            ->attr('name', $this->getName() . "[]")
            ->attr('multiple', 'multiple')
            ->attr('accept', $this->accept)
            ->attr('style', $inputStyle);

        // Add a button to show more file input form elements.
        if ($this->allowMultiple) {
            $addButton = $element->add('button')
                ->attr('type', 'button')
                ->attr('class', 'btn btn-' . $this->getName())
                ->attr('onclick', $this->getName() . '_add({})')
                ->attr('style', 'margin-left: 15px;');

            $addButton->add('i')
                ->attr('class', 'fa fa-plus')
                ->addHtml('&nbsp;');

            $addButton->addHtml(trans("Add an upload field"));

            // JavaScript to add a new input element when the button is clicked.
            $element->add('script')
                ->addHtml('
                    var $wrapper = $("#' . $this->getName() . '_wrapper");

                    function ' . $this->getName() . '_add() {
                        $wrapper.append(
                            "<input class=\"form-control\" name=\"' . $this->getName() . '[]\" "
                            + "multiple=\"multiple\" accept=\"application/pdf\" style=\"' . $inputStyle . '\" type=\"file\">"
                        );
                    }
                ');

            $element->add('br');
        }

        $this->renderFiles($element);

        return $element->render();
    }

    /**
     * @param HtmlBuilder $element
     */
    public function renderFiles(HtmlBuilder $element)
    {
        $json = $this->value;

        $values = [];
        if (!empty($json)) {
            $values = json_decode($json);
        }
        if (is_array($values)) {
            foreach ($values as $value) {
                $element->add('input')
                    ->attr('type', "checkbox")
                    ->attr('checked', "true")
                    ->attr('value', "true")
                    ->attr(
                        'name',
                        $this->getName() . "_checkbox[" . $value->name . "]"
                    );

                $label = $element->add('a')->attr('href', $value->link);

                $label->addText($value->name);
            }
        }
    }

    /**
     * @param string $file
     *
     * @return array
     */
    public function storeFile($file)
    {
        $var = StorageServer::uploadToAttachmentServer($file);

        $arr = [];
        if (!empty($var) && !array_key_exists("succes", $var)) {
            $arr["name"] = $var["file"]["name"];
            $arr["link"] = $var["file"]["location"];
        }

        return $arr;
    }

    /**
     * @param string $filetype
     *
     * @return $this
     */
    public function setAccept($filetype)
    {
        $this->accept = $filetype;

        return $this;
    }
}
