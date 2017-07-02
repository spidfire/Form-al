***REMOVED***

namespace FormAl\Elements;

use FormAl\FormAlAbstract;
use FormAl\Validators\ValidPostalCode;

/**
 * Class PostalCode
 *
 * @package FormAl\Elements
 */
class PostalCode extends Input
{
    /**
     * @param string         $name
     * @param FormAlAbstract $formal
     */
    public function __construct($name, FormAlAbstract $formal)
    {
        parent::__construct($name, $formal);

        $this->addValidator(new ValidPostalCode());
    ***REMOVED***
***REMOVED***
