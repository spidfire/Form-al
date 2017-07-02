***REMOVED***

namespace FormAl\Validators;

use FormAl\ValidatorBase;
use FormAl\ElementBase;

/**
 * Class ExactCount
 *
 * @package FormAl\Validators
 */
class ExactCount extends ValidatorBase
{
    /** @var null|int */
    public $exactCount = null;

    /**
     * @param int $count
     */
    public function __construct($count)
    {
        $this->exactCount = $count;
    ***REMOVED***

    /**
     * @param array       $data
     * @param ElementBase $element
     *
     * @return bool
     */
    public function validateInput($data, ElementBase $element)
    {
        if (is_array($data)) {
            if (count($data) == $this->exactCount) {
                return true;
            ***REMOVED*** else {
                $element->error(
                    "Verkeerde hoeveelheid",
                    "De invoer moet bestaan uit  exact {$this->exactCount***REMOVED*** elementen"
                );
            ***REMOVED***
        ***REMOVED*** else {
            $element->error(
                "Te weinig inhoud",
                "De invoer moet bestaan uit  exact {$this->exactCount***REMOVED*** elementen"
            );
        ***REMOVED***

        return false;
    ***REMOVED***
***REMOVED***
