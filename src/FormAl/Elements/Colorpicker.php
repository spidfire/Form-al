***REMOVED***

namespace FormAl\Elements;

use FormAl\ElementBase;
use FormAl\Utilities\HtmlBuilder;
use FormAl\Validators\MinLength;

/**
 * Class Colorpicker
 *
 * @package FormAl\Elements
 */
class Colorpicker extends ElementBase
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
            ->attr('value', $this->getValue());

        $element->add('input')
            ->attr('name', $this->getName())
            ->attr('type', "text")
            ->attr('value', $this->getValue())
            ->attr('class', "form-control")
            ->attr('style', "display:inline; width: 366px;");

        $element->add('span')
            ->attr('class', "input-group-addon")
            ->attr(
                'style',
                "width:60px;display:inline;padding-bottom:5px;padding-top:8px;padding-left:22px;"
            );

        $element->add('i');


        //->attr('style', 'height: 32px; width: 400px;');

        $element->addHtml(
            "<script>$('#" . $this->getName() . "').colorpicker();</script>"
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
