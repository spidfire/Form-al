***REMOVED***

namespace FormAl\Validators;

use FormAl\ElementBase;
use FormAl\ValidatorBase;

/**
 * Class IntValue
 *
 * @package FormAl\Validators
 */
class IntValue extends ValidatorBase
{
    /** @var int */
    public $minvalue = 0;
    /** @var string */
    public $errorTitle = "Dit is geen geheel getal";
    /** @var string */
    public $errorText = "De waarde van dit veld moet een geheel getal zijn";

    /**
     * @param int         $data
     * @param ElementBase $element
     *
     * @return bool
     */
    public function validateInput($data, ElementBase $element)
    {
        if (!is_int($data) && !ctype_digit($data)) {
            $element->error($this->errorTitle, $this->errorText);
        ***REMOVED*** else {
            return true;
        ***REMOVED***

        return false;
    ***REMOVED***
***REMOVED***
