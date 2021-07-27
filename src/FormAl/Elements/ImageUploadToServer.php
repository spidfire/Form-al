<?php

namespace FormAl\Elements;

use FormAl\FormAlAbstract;
use FormAl\Utilities\HtmlBuilder;
use FormAl\Validators\ValidImage;
// TODO: Use correct storage server
use StorageServer;
// TODO: Use correct media server
use MediaServer;

/**
 * Class ImageUploadToServer
 *
 * @package FormAl\Elements
 */
class ImageUploadToServer extends Input
{
    /** @var string */
    public $publicPath = "images/";
    /** @var string */
    public $localPath = "images/";

    /**
     * @param string         $name
     * @param FormAlAbstract $formal
     */
    public function __construct($name, $formal)
    {
        parent::__construct($name, $formal);

        $this->addValidator(new ValidImage());
    }

    /**
     * Add validator after deserialize.
     */
    public function __wakeup()
    {
        $this->addValidator(new ValidImage());
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        if (!empty($_POST['delete' . $this->getName()])) {
            return '';
        } elseif (isset($_FILES[$this->getName()])) {
            if ($_FILES[$this->getName()]['size'] > 0) {
                $this->value = StorageServer::storePicture(
                    $_FILES[$this->getName()]
                );
            } else {
                $this->value = $value;
            }
        } else {
            $this->value = $value;
        }

        return $this;
    }

    /**
     * @return array|bool|null|string
     */
    public function getValue()
    {
        if (empty($this->value)) {
            $this->setValue(null);
        } elseif (is_array($this->value)) {
            return null;
        }

        return $this->value;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        $element = new HtmlBuilder('div');
        if (!empty($this->getValue()) && !is_array($this->getValue())) {
            // $this->getValue is array containing errors if upload failed.

            $element->add('input.form-control')
                ->attr('type', 'hidden')
                ->attr('name', $this->getName())
                ->attr('value', $this->getValue());

            // displays image
            $url = MediaServer::createUrl('get', $this->getValue());

            $anchor = $element->add('a')
                ->attr('href', $url . '?mode=full')
                ->attr('target', '_blank');
            $anchor->add('img')
                ->attr('class', 'superuberimagehack')
                ->attr('src', $url);
            // for changing the current image
            $element->add('input.form-control')
                ->attr('type', 'file')
                ->attr('name', $this->getName())
                ->attr('accept', "image/*");
            $element->add('input')
                ->attr('type', 'checkbox')
                ->attr('name', 'delete' . $this->getName())
                ->attr('label', 'Delete image');
            $element->addText(trans("Delete this picture"));
        } else {
            $element->add('input.form-control')
                ->attr('type', 'file')
                ->attr('name', $this->getName())
                ->attr('accept', "image/*");

            if ($this->isDisabled()) {
                $element->attr('disabled', 'disabled');
            }
        }

        return $element->render();
    }

    /**
     * @return bool
     */
    public function resetUploaded()
    {
        $this->value = null;

        return true;
    }
}
