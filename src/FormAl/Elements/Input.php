***REMOVED***

namespace FormAl\Elements;

use FormAl\ElementBase;
use FormAl\Utilities\HtmlBuilder;
use FormAl\Validators\MinLength;
use FormAl\Validators\MaxLength;

/**
 * Class Input
 *
 * @package FormAl\Elements
 */
class Input extends ElementBase
{
    /** @var string */
    public $type = "text";
    /** @var string */
    private $labelname = "";

    /** @var int */
    private $maxLength = null;

    const DEFAULT_MAX_LENGTH = 128;

    /**
     * @param string $text
     *
     * @return $this
     */
    public function label($text)
    {
        $this->labelname = $text;

        return $this;
    ***REMOVED***

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->labelname;
    ***REMOVED***

    /**
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        $element = new HtmlBuilder('input.form-control');
        $element->attr('type', $this->type)
            ->attr('name', $this->getName())
            ->attr('value', $this->getValue());
        if (!empty($this->maxLength)) {
            $element->attr('maxlength', $this->maxLength);
        ***REMOVED***

        if (!$this->hasAutoFill) {
            $element->attr('readonly', 'true')
                ->attr('onfocus', 'javascript:this.removeAttribute(\'readonly\');')
                ->attr(
                    'onmouseover', 'javascript:this.removeAttribute(\'readonly\');'
                )
                ->attr('autocomplete', 'off');
        ***REMOVED***

        return $element->render();
    ***REMOVED***

    /**
     * @param int $length
     *
     * @return $this
     */
    public function min($length)
    {
        $this->addValidator(new MinLength($length));

        return $this;
    ***REMOVED***

    /**
     * Add validator for setting a maximum on the string length.
     *
     * @param int $length
     *
     * @return $this
     */
    public function max($length)
    {
        if (empty($length)) {
            $length = self::DEFAULT_MAX_LENGTH;
        ***REMOVED***

        $this->addValidator(new MaxLength($length));

        $this->maxLength = $length;

        return $this;
    ***REMOVED***
***REMOVED***
