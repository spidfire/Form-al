***REMOVED***

namespace FormAl\Validators;

use FormAl\ElementBase;
use FormAl\ValidatorBase;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;

/**
 * Class ValidPhoneNumber
 *
 * @package FormAl\Validators
 */
class ValidPhoneNumber extends ValidatorBase
{
    /** @var string */
    private $errorTitle = "Error";
    /** @var string */
    private $errorText = "This is not a valid phone number";

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
    ***REMOVED***

    /**
     * @param string $number
     * @param ElementBase $element
     *
     * @return bool
     */
    public function validateInput($number, ElementBase $element)
    {
        if (is_string($number)) {
            if (strlen($number) == 0) {
                return true;
            ***REMOVED***

            $phoneUtil = PhoneNumberUtil::getInstance();

            $parsedNum = null;
            try {
                $parsedNum = $phoneUtil->parse($number, "NL");
            ***REMOVED*** catch (NumberParseException $e) {
            ***REMOVED***

            // ParsedNum should not be empty and should be a valid number.
            if (empty($parsedNum) || !$phoneUtil->isValidNumber($parsedNum)) {
                $element->error(
                    trans($this->errorTitle),
                    trans($this->errorText)
                );
            ***REMOVED***
        ***REMOVED*** else {
            $element->error(
                "Unkown data type",
                "The type of this value is not a String"
            );
        ***REMOVED***

        return false;
    ***REMOVED***
***REMOVED***
