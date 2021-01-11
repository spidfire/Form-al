<?php

namespace FormAl\Validators;

use FormAl\ElementBase;
use FormAl\Elements\FileUpload;
use FormAl\Elements\ImageUploadToServer;
use FormAl\ValidatorBase;

/**
 * Class NotNull
 *
 * @package FormAl\Validators
 */
class NotNull extends ValidatorBase
{
    /** @var string */
    public $transEmpty = "Leeg veld";
    /** @var string */
    public $transEmptyText = "Dit veld mag niet leeg zijn";

    /**
     * @param mixed       $data
     * @param ElementBase $element
     *
     * @return bool
     */
    public function validateInput($data, ElementBase $element)
    {
        if (is_scalar($data)) {
            if (!empty($data)) {
                return true;
            } else {
                $element->error($this->transEmpty, $this->transEmptyText);
            }
        } elseif (is_array($data)) {
            if (count($data) > 0) {
                return true;
            } else {
                $element->error($this->transEmpty, $this->transEmptyText);
            }
        } elseif (is_null($data)) {
            $element->error($this->transEmpty, $this->transEmptyText);
            if ($element instanceof ImageUploadToServer || $element instanceof FileUpload) {
                foreach($_FILES as $key => $files) {
                    if ($key == $element->getName() && $_FILES[$key]['size'] > 0) {
                        return true;
                    }
                }
            }
        } else {
            $element->error(
                "Onbekende inhoud",
                "De inhoud van dit veld is niet correct. (is null)"
            );
        }

        return false;
    }
}
