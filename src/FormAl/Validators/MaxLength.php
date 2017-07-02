<?php

namespace FormAl\Validators;

use FormAl\ElementBase;
use FormAl\ValidatorBase;

/**
 * Class MaxLength
 *
 * @package FormAl\Validators
 */
class MaxLength extends ValidatorBase
{
    public $maxLength = 0;

    /**
     * @param int $length
     */
    public function __construct($length)
    {
        $this->maxLength = $length;
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
            if (strlen($data) <= $this->maxLength) {
                return true;
            } else {
                $element->error(
                    trans("Error"),
                    trans(
                        "This text is too long. The maximum length is %s character.",
                        $this->maxLength
                    )
                );
            }
        } else {
            $element->error(
                "Onbekende inhoud",
                "De inhoud van dit veld is niet correct. (max lengte check)"
            );
        }

        return false;
    }
}
