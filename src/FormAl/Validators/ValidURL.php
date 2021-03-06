<?php

namespace FormAl\Validators;

use FormAl\ElementBase;
use FormAl\ValidatorBase;

/**
 * Class ValidURL
 *
 * @package FormAl\Validators
 */
class ValidURL extends ValidatorBase
{
    /** @var string */
    public $errorTitle = "Fout";
    /** @var string */
    public $errorText = "Dit is niet een geldig URL";

    /**
     * @param string $title
     * @param string $error
     *
     * @return $this
     */
    public function setError($title, $error)
    {
        $this->errorTitle = $title;
        $this->errorText = $error;

        return $this;
    }

    /**
     * @param string      $data
     * @param ElementBase $element
     *
     * @return bool
     */
    public function validateInput($data, ElementBase $element)
    {
        if (\is_string($data)) {
            if ($data === '') {
                return true;
            }

            $data = isset(parse_url($data)['scheme'])
                ? $data
                : 'http://' . $data;
            if (filter_var($data, FILTER_VALIDATE_URL) !== false) {
                return true;
            }

            $element->error($this->errorTitle, $this->errorText);
        } else {
            $element->error(
                'Unkown data type',
                'The type of this value is not a string.'
            );
        }

        return false;
    }
}
