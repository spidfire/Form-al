<?php

namespace FormAl\Validators;

use FormAl\ElementBase;
use FormAl\Elements\ImageUploadToServer;
use FormAl\ValidatorBase;

/**
 * Class ValidInput
 *
 * @package FormAl\Validators
 */
class ValidImage extends ValidatorBase
{
    /**
     * @param mixed       $data
     * @param ElementBase $element
     *
     * @return bool
     */
    public function validateInput($data, ElementBase $element)
    {
        if (!is_array($data)) {
            return true;
        } else {
            /** @var ImageUploadToServer $element */
            $element->resetUploaded();

            foreach ($data as $error) {
                //Split in title and message
                list($title, $message) = explode('.', $error, 2);
                $element->error($title, $message);
            }

            return false;
        }
    }
}
