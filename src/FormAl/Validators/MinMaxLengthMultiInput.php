<?php

namespace FormAl\Validators;

use FormAl\ElementBase;
use FormAl\ValidatorBase;

/**
 * Class MinMaxLengthMultiInput
 *
 * @package FormAl\Validators
 */
class MinMaxLengthMultiInput extends ValidatorBase
{
    /**
     * @var int
     */
    public $minlength = 0;
    /**
     * @var int
     */
    public $maxlength = 128;
    /**
     * @var bool
     */
    public $ignoreEmpty = false;

    /**
     * @param int $min
     * @param int $max
     * @param bool $ignoreEmpty If your program will do sanitizing checks during runtime and ignore empty fields,
     *   allow this.
     */
    public function __construct($min, $max = 128, $ignoreEmpty = false)
    {
        $this->minlength = $min;
        $this->maxlength = $max;

        $this->ignoreEmpty = $ignoreEmpty;
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
            foreach($data as $elementData) {
                if ($this->ignoreEmpty && empty($elementData)) {
                    continue;
                }

                $len = strlen($elementData);

                if ($len < $this->minlength || $len > $this->maxlength) {
                    if ($len < $this->minlength) {
                        $element->error(
                            trans('Invoer te kort'), trans(
                                'Invoer moet minimaal %d karakters bevatten', $this->minlength
                            )
                        );
                    } else {
                        $element->error(
                            trans('Invoer te kort'), trans(
                                'Invoer mag maximaal %d karakters bevatten', $this->maxlength
                            )
                        );
                    }
                    return false;
                }
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
