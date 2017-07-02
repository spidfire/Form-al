***REMOVED***

namespace FormAl\Validators;

use FormAl\ElementBase;
use FormAl\ValidatorBase;

/**
 * Class MinPowerOfTwoValue
 *
 * @package FormAl\Validators
 */
class MinPowerOfTwoValue extends ValidatorBase
{
    /** @var int */
    public $minvalue = 0;
    /** @var string */
    public $errorLowTitle = "Onjuiste invoer";
    /** @var string */
    public $errorLowText = "Selecteer aub ��n juiste waarde";
    /** @var int */
    public $minlength;

    /**
     * Constructor of this class
     *
     * @param int $length
     */
    public function __construct($length)
    {
        $this->minlength = $length;
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
            if (($data & ($data - 1)) == 0 && $data >= $this->minvalue) {
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
                "De inhoud van dit veld is niet correct."
            );
        ***REMOVED***

        return false;
    ***REMOVED***
***REMOVED***
