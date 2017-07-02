***REMOVED***

namespace FormAl\Elements;

use FormAl\Utilities\HtmlBuilder;

/**
 * Class Chosen
 *
 * @package FormAl\Elements
 */
class Chosen extends Input
{
    /** @var array */
    public $options = [];
    /** @var array */
    private $selected = [];

    /**
     * @param array $options
     *
     * @return $this
     */
    public function options($options)
    {
        $this->options = $options;

        return $this;
    ***REMOVED***

    /**
     * @param array $selected
     *
     * @return $this
     */
    public function selected($selected)
    {
        $this->selected = $selected;

        return $this;
    ***REMOVED***

    /**+
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        $element = new HtmlBuilder('select.form-control');
        $element->attr('name', $this->getName() . "[]");
        $element->attr('multiple', 'multiple');
        $element->attr('class', 'chosen-select form-control');

        $this->optGroups($element, $this->options);

        return $element->render() . "<script type='text/javascript'>
        $(\".chosen-select\").chosen();
        </script>";
    ***REMOVED***

    /**
     * @param HtmlBuilder $element
     * @param array       $data
     */
    public function optGroups(HtmlBuilder $element, $data)
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $sub = $element->add('optgroup')
                    ->attr('label', $key);
                $this->optGroups($sub, $value);
            ***REMOVED*** else {
                $element->add('option')
                    ->attr('value', $key)
                    ->attr(
                        'selected',
                        in_array($key, $this->selected) ? "checked" : null
                    )
                    ->addText($value);
            ***REMOVED***
        ***REMOVED***
    ***REMOVED***
***REMOVED***
