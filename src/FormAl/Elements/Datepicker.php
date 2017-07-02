***REMOVED***

namespace FormAl\Elements;

use FormAl\ElementBase;
use FormAl\Utilities\HtmlBuilder;
use FormAl\Validators\MinLength;

/**
 * Class Datepicker
 *
 * @package FormAl\Elements
 */
class Datepicker extends ElementBase
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
        $element = new HtmlBuilder('input.form-control');
        $element->attr('type', $this->type)
            ->attr('name', $this->getName())
            ->attr('id', $this->getName());

        $dateStr = $this->getValue();
        if ($dateStr instanceof \DateTime) {
            $dateStr = $dateStr->format("d-m-Y H:i");
        ***REMOVED***
        $element->attr('value', $dateStr);
        //->attr('style', 'height: 32px; width: 400px;');

        if (isset($_COOKIE['lang'])) {
            $lang = explode('_', $_COOKIE['lang']);
            $lang = $lang[0];
        ***REMOVED*** else {
            $lang = 'en';
        ***REMOVED***
        $element->addHtml(
            "<script>$('#" . $this->getName()
            . "').datetimepicker({
                    scrollMonth:false,
                    scrollTime:false,
                    scrollInput:false,
                    timepicker:true,
                    lang:'".$lang."',
                    format:'d-m-Y H:i',
                ***REMOVED***);
            </script>"
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
