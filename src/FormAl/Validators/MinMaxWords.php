<?php

namespace FormAl\Validators;

use FormAl\ElementBase;
use FormAl\ValidatorBase;

/**
 * Class MinMaxWords
 *
 * @package FormAl\Validators
 */
class MinMaxWords extends ValidatorBase
{
    /** @var int */
    public $min = 0;
    /** @var int */
    public $max = 10000000;

    /**
     * @param int $min
     * @param int $max
     */
    public function __construct($min, $max)
    {
        $this->min = $min;
        $this->max = $max;
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
            $words = preg_split("/\\s+/", $data);
            if (count($words) >= $this->min && count($words) <= $this->max) {
                return true;
            } else {
                $element->error(
                    "Verkeerde hoeveelheid woorden",
                    "De invoer moet tussen de {$this->min} en {$this->max} aantal woorden, het zijn er momenteel: "
                    . count($words)
                );
            }
        } else {
            $element->error("Onbekende inhoud", "De inhoud is niet correct");
        }

        return false;
    }
}
