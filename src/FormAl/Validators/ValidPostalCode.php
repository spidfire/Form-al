***REMOVED***

namespace FormAl\Validators;

use FormAl\ElementBase;
use FormAl\ValidatorBase;

/*
 * Class ValidPostalCode
 *
 * @package FormAl\Validators
 */
class ValidPostalCode extends ValidatorBase
{
    /** @var string */
    private $errorTitle = "Error";
    /** @var string */
    private $errorText = "This is not a valid postal code";

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
    public function validateInput($postalCode, ElementBase $element)
    {
        if (is_string($postalCode)) {
            if (strlen($postalCode) == 0) {
                return true;
            ***REMOVED***

            if (trans('regexp-validate-postal-code')
                == 'regexp-validate-postal-code'
                || preg_match(
                    trans('regexp-validate-postal-code'),
                    $postalCode
                )
            ) {
                return true;
            ***REMOVED***

            $element->error(
                trans($this->errorTitle),
                trans($this->errorText)
            );
        ***REMOVED*** else {
            $element->error(
                "Unkown data type",
                "The type of this value is not a String"
            );
        ***REMOVED***

        return false;
    ***REMOVED***
***REMOVED***
