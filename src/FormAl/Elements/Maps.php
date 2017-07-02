***REMOVED***

namespace FormAl\Elements;

use FormAl\ElementBase;
use FormAl\Utilities\HtmlBuilder;
use FormAl\Validators\MinLength;

/**
 * Class Maps
 *
 * @package FormAl\Elements
 */
class Maps extends ElementBase
{
    /** @var string */
    public $type = "div";
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
        $element = new HtmlBuilder('div.form-control');
        $element->attr('type', $this->type)
            ->attr('name', $this->getName())
            ->attr('id', 'map_canvas')
            ->attr('value', $this->getValue())
            ->attr('style', 'height: 350px; width: 500px;');

        $element->addHtml(
            '<script src="https://maps.google.com/maps/api/js?libraries=places&region=uk&language=en&sensor=true">'
            . '</script>'
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
