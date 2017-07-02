***REMOVED***

namespace FormAl\Elements;

use FormAl\ElementBase;
use FormAl\Utilities\HtmlBuilder;
use FormAl\Validators\MinLength;

/**
 * Class FaIconPicker
 *
 * @package FormAl\Elements
 */
class FaIconPicker extends ElementBase
{
    /** @var string */
    public $type = "text";
    /** @var string */
    private $labelname = "";

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
        $element = new HtmlBuilder('div');
        $element->attr('type', $this->type)
            ->attr('id', $this->getName())
            ->attr('value', $this->getValue())
            ->attr('class', "input-group iconpicker-container");

        $oldIcon = '';
        if (!empty($this->getValue())) {
            $oldIcon = $this->getValue();
        ***REMOVED***
        if (!empty($oldIcon) && stristr($this->getValue(), 'fa-')
            && stristr($this->getValue(), 'fa ') == false
        ) {
            $oldIcon = 'fa ' . $oldIcon;
        ***REMOVED***

        $element->addHtml(
            '
            <button style="background: #29b9b5;" class="btn btn-default" id="target" role="" name="'
            . $this->getName() .
            '" data-icon="' . $oldIcon . '"></button>

            <script type="application/javascript">
            $(\'#target\').iconpicker({
                align: \'center\', // Only in div tag
                arrowClass: \'btn-danger\',
                arrowPrevIconClass: \'cl-icon-arrow-left-gradient\',
                arrowNextIconClass: \'cl-icon-arrow-right-gradient\',
                cols: 8,
                footer: true,
                header: true,
                iconset: \'fontawesome\',
                labelHeader: \'{0***REMOVED*** of {1***REMOVED*** pages\',
                labelFooter: \'{0***REMOVED*** - {1***REMOVED*** of {2***REMOVED*** icons\',
                placement: \'bottom\', // Only in button tag
                rows: 4,
                search: true,
                searchText: \'Search\',
                selectedClass: \'btn-success\',
                unselectedClass: \'\'
            ***REMOVED***);
            </script>
'
        );

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
***REMOVED***
