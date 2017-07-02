***REMOVED***

namespace FormAl\Validators;

use FormAl\ElementBase;
use FormAl\ValidatorBase;

/**
 * Class MinFileSize
 *
 * @package FormAl\Validators
 */
class MinFileSize extends ValidatorBase
{
    /** @var string */
    public $transEmpty = "Bestand te klein";
    /** @var string */
    public $transEmptyText = "Bestand wat ingeleverd is moet minimaal 1 MB zijn";

    /**
     * @param string      $data
     * @param ElementBase $element
     *
     * @return bool
     */
    public function validateInput($data, ElementBase $element)
    {
        if (is_string($data)) {
            if (filesize($data) < 1024 * 1024) {
                return true;
            ***REMOVED*** else {
                $element->error($this->transEmpty, $this->transEmptyText);
            ***REMOVED***
        ***REMOVED*** elseif (is_null($data)) {
            $element->error($this->transEmpty, $this->transEmptyText);
        ***REMOVED*** else {
            $element->error(
                "Onbekende inhoud",
                "De inhoud van dit veld is niet correct. (is null)"
            );
        ***REMOVED***

        return false;
    ***REMOVED***
***REMOVED***
