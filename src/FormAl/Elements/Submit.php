***REMOVED***

namespace FormAl\Elements;

use FormAl\ElementBase;
use FormAl\Utilities\HtmlBuilder;

/**
 * Class Submit
 *
 * @package FormAl\Elements
 */
class Submit extends ElementBase
{
    /** @var string */
    public $value = null;
    /** @var bool */
    public $markForExport = false;

    /**
     * @return bool
     */
    public function isClicked()
    {
        $updateArray = $this->getFormAl()->updatedValues();
        $name = md5($this->getName());

        return isset($updateArray[$name]);
    ***REMOVED***

    /**
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        $element = new HtmlBuilder('input.form-control.btn.btn-primary.formal-element');
        $element->attr('style', 'width:250px');
        $element->attr('type', 'submit')
            ->attr('name', md5($this->getName()))
            ->attr('value', $this->getLabel());

        return $element->render();
    ***REMOVED***
***REMOVED***
