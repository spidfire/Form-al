***REMOVED***

namespace FormAl\Validators;

use FormAl\ElementBase;
use FormAl\ValidatorBase;

/**
 * Class MinMaxIntValue
 *
 * @package FormAl\Validators
 */
class MinMaxIntValue extends ValidatorBase
{
    /** @var int */
    public $minvalue = 0;
    /** @var int */
    public $maxvalue = 1000;
    /** @var string */
    public $errorLowTitle = "Veld waarde te laag";
    /** @var string */
    public $errorLowText = "De waarde van dit veld moet minimaal %d zijn";
    /** @var string */
    public $errorHighTitle = "Veld waarde te hoog";
    /** @var string */
    public $errorHighText = "De waarde van dit veld mag maximaal %d zijn";

    /**
     * @param int $min
     * @param int $max
     */
    public function __construct($min, $max)
    {
        $this->minvalue = $min;
        $this->maxvalue = $max;
    ***REMOVED***

    /**
     * @param int         $data
     * @param ElementBase $element
     *
     * @return bool
     */
    public function validateInput($data, ElementBase $element)
    {
        if (is_int($data) || ctype_digit($data)) {
            $data = (int)$data;
            if ($data >= $this->minvalue && $data <= $this->maxvalue) {
                return true;
            ***REMOVED*** else {
                if ($data < $this->minvalue) {
                    $element->error(
                        $this->errorLowTitle,
                        sprintf($this->errorLowText, $this->minvalue)
                    );
                ***REMOVED*** else {
                    $element->error(
                        $this->errorHighTitle,
                        sprintf($this->errorHighText, $this->maxvalue)
                    );
                ***REMOVED***
            ***REMOVED***
        ***REMOVED*** else {
            $element->error(
                "Onbekende inhoud",
                "De inhoud van dit veld is niet correct. (min lengte check)"
            );
        ***REMOVED***

        return false;
    ***REMOVED***
***REMOVED***

