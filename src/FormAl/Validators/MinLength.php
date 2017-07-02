<?php

namespace FormAl\Validators;

use FormAl\ElementBase;
use FormAl\ValidatorBase;

/**
 * Class MinLength
 *
 * @package FormAl\Validators
 */
class MinLength extends ValidatorBase
{
    public $minlength = 0;

    /**
     * @param int $length
     */
    public function __construct($length)
    {
        $this->minlength = $length;
    }

    /**
     * @param string      $data
     * @param ElementBase $element
     *
     * @return bool
     */
    public function validateInput($data, ElementBase $element)
    {
        if (is_string($data)) {
            if (strlen($data) >= $this->minlength) {
                return true;
            } else {
                $element->error(
                    "Veld inhoud te kort",
                    "De lengte van de waardes moet langer zijn dan "
                    . $this->minlength . " characters"
                );
            }
        } else {
            $element->error(
                "Onbekende inhoud",
                "De inhoud van dit veld is niet correct. (min lengte check)"
            );
        }

        return false;
    }
}
