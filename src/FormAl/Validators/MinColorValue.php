<?php

namespace FormAl\Validators;

use FormAl\ElementBase;
use FormAl\ValidatorBase;
use Exception;

/**
 * Class MinColorValue
 *
 * @package FormAl\Validators
 */
class MinColorValue extends ValidatorBase
{
    public $minColor = 0;

    /**
     * @param int $length
     */
    public function __construct($luma = 220)
    {
        if ($luma < 0 || $luma > 255) {
            throw new Exception("The luma value should be between 0 and 255");
        }
        $this->minColor = $luma;
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
            $data = substr($data, 1);  // strip #
            $rgb = hexdec($data);      // convert rrggbb to decimal
            $r = ($rgb >> 16) & 0xff;  // extract red
            $g = ($rgb >>  8) & 0xff;  // extract green
            $b = ($rgb >>  0) & 0xff;  // extract blue

            $luma = 0.2126 * $r + 0.7152 * $g + 0.0722 * $b; // per ITU-R BT.709


            if ($luma < $this->minColor) {
                return true;
            } else {
                $element->error(
                    trans("Error"),
                    trans("This color is too bright. Pick a different color.")
                );
            }
        } else {
            $element->error(
                trans("Unknown content"),
                trans("The content of this field is not in the right format. Change it to a hexidecimal color value.")
            );
        }

        return false;
    }

}
