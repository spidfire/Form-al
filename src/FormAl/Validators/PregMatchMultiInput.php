<?php
namespace FormAl\Validators;

use FormAl\ElementBase;
use FormAl\ValidatorBase;

/**
 * Class PregMatch
 *
 * @package FormAl\Validators
 */
class PregMatchMultiInput extends ValidatorBase
{
    /** @var string */
    public $regex = '';
    /** @var array */
    private $results = [];
    public $errorTitle = "Fout";
    public $errorText = "De gegeven text voldoet niet aan de regels";

    /**
     * @param string $regex
     */
    public function __construct($regex)
    {
        $this->regex = $regex;
    }

    /**
     * @return array
     */
    public function getResults()
    {
        return $this->results;
    }

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
        $this->results = [];
        if (is_array($data)) {
            foreach($data as $elementData) {
                if (!preg_match($this->regex, $elementData, $this->results)) {
                    $element->error($this->errorTitle, $this->errorText);
                    return false;
                }
            }
            return true;
        } else {
            $element->error(
                "Unkown data type",
                "The type of this value is not a String"
            );
        }

        return false;
    }
}
