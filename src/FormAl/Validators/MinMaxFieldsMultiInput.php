<?php

namespace FormAl\Validators;

use FormAl\ElementBase;
use FormAl\ValidatorBase;

/**
 * Class MinMaxFieldsMultiInput
 *
 * @package FormAl\Validators
 */
class MinMaxFieldsMultiInput extends ValidatorBase
{
    /**
     * @var int
     */
    public $minlength = 2;
    /**
     * @var int
     */
    public $maxlength = 4;

    /**
     * @param int $min
     * @param int $max
     * @throws \Exception
     */
    public function __construct($min, $max = 4)
    {
        if ($min > $max)
            throw new \Exception("Minimum length may not be larger than the maximum length.");

        $this->minlength = $min;
        $this->maxlength = $max;
    }

    /**
     * @param string      $data
     * @param ElementBase $element
     *
     * @return bool
     */
    public function validateInput($data, ElementBase $element)
    {
        if (is_array($data)) {
            $count = 0;
            foreach ($data as $fields) {
                if (!empty($fields)) {
                    $count++;
                }
            }

            if ($count < $this->minlength || $count > $this->maxlength) {
                if ($count < $this->minlength) {
                    $element->error(
                        trans('Niet genoeg velden'), trans('Je moet minimaal %d velden invullen', $this->minlength)
                    );
                } else {
                    $element->error(
                        trans('Teveel velden'), trans('Je mag maximaal %d velden invullen', $this->maxlength)
                    );
                }
                return false;
            }
            return true;
        } else {
            $element->error(
                trans("Unknown data type"),
                trans("The type of this value is not an Array")
            );
        }

        return false;
    }
}
