***REMOVED***

namespace FormAl\Validators;

use FormAl\ElementBase;
use FormAl\ValidatorBase;

/**
 * Class MinIntValue
 *
 * @package FormAl\Validators
 */
class MinIntValue extends ValidatorBase
{
    /** @var int */
    public $minvalue = 0;
    /** @var string */
    public $errorLowTitle = "Veld waarde te laag";
    /** @var string */
    public $errorLowText = "De waarde van dit veld moet minimaal %d zijn";

    /**
     * @param int $length
     */
    public function __construct($length)
    {
        $this->minvalue = $length;
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
            if ($data >= $this->minvalue) {
                return true;
            ***REMOVED*** else {
                $element->error(
                    $this->errorLowTitle,
                    sprintf($this->errorLowText, $this->minvalue)
                );
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
