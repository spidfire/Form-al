***REMOVED***

namespace FormAl\Elements;

use FormAl\Utilities\HtmlBuilder;

/**
 * Class Select
 *
 * @package FormAl\Elements
 */
class Select extends Input
{
    /** @var array */
    public $options = [];

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
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        $element = new HtmlBuilder('select.form-control');
        $element->attr('name', $this->getName());

        $this->optGroups($element, $this->options);

        return $element->render();
    ***REMOVED***

    /**
     * @param HtmlBuilder $builder
     * @param array       $data
     */
    public function optGroups(HtmlBuilder $builder, $data)
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $sub = $builder->add('optgroup')
                    ->attr('label', $key);
                $this->optGroups($sub, $value);
            ***REMOVED*** else {
                $builder->add('option')
                    ->attr('value', $key)
                    ->attr(
                        'selected',
                        ($key == $this->getValue() ? 'selected' : null)
                    )
                    ->addText($value);
            ***REMOVED***
        ***REMOVED***
    ***REMOVED***
***REMOVED***
