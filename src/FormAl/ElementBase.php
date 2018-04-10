***REMOVED***

namespace FormAl;

// TODO: Fix correct Markdown framework
use Markdown;

/**
 * Class ElementBase
 *
 * @package FormAl
 */
abstract class ElementBase
{
    protected $markdownBaseDir = "/../../";
    /** @var string */
    private $uniquename;
    /** @var FormAlAbstract */
    private $formal;
    /** @var array */
    private $errors = [];
    /** @var string */
    private $tooltip = "";
    /** @var ValidatorBase[] */
    private $validators = [];
    /** @var bool */
    public $fullWidth = false; //
    /** @var bool Should this element be exported? */
    /** @var bool */
    public $markForExport = true;
    /** @var string|null */
    public $value = null;
    /** @var string */
    private $markdownInfo = "";
    /** @var bool */
    private $folded = false;
    /** @var bool  */
    protected $hasAutoFill = true;

    /**
     * @return string
     */
    final public function getName()
    {
        $name = $this->getFormAl()->getName() . $this->getUniqueName();

        return preg_replace("/[^a-zA-Z0-9-]+/", "_", $name);
    ***REMOVED***

    /**
     * @return string
     */
    final public function getUniqueName()
    {
        return $this->uniquename;
    ***REMOVED***

    /**
     * @return bool
     */
    public function usesFullWidth()
    {
        return $this->fullWidth;
    ***REMOVED***

    /**
     * @param string         $name
     * @param FormAlAbstract $formal
     */
    public function __construct($name, FormAlAbstract $formal)
    {
        $this->uniquename = $name;
        $this->formal = $formal;
    ***REMOVED***

    /**
     * @return FormAlAbstract
     */
    public function getFormAl()
    {
        return $this->formal;
    ***REMOVED***

    public function label($text)
    {
        return $text;
    ***REMOVED***

    /**
     * @return string
     */
    public function getLabel()
    {
        return ucfirst($this->getUniqueName());
    ***REMOVED***

    /**
     * @param ValidatorBase $validator
     *
     * @return $this
     */
    public function addValidator(ValidatorBase $validator)
    {
        $this->validators[] = $validator;

        return $this;
    ***REMOVED***

    abstract public function render();

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    ***REMOVED***

    /**
     * @param string $value
     *
     * @return $this
     */
    public function defaultValue($value)
    {
        if (is_null($this->value)) {
            $this->value = $value;
        ***REMOVED***

        return $this;
    ***REMOVED***

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->getValue());
    ***REMOVED***

    /**
     * @return string|null
     */
    public function getValue()
    {
        $submit = $this->getSubmitValue();
        if (!is_null($submit)) {
            return $submit;
        ***REMOVED*** else {
            return $this->value;
        ***REMOVED***
    ***REMOVED***

    /**
     * @param string $tooltip
     *
     * @return ElementBase
     */
    public function tooltip($tooltip)
    {
        return $this->setTooltip($tooltip);
    ***REMOVED***

    /**
     * @return string
     */
    public function getTooltip()
    {
        return $this->tooltip;
    ***REMOVED***

    /**
     * @param string $tooltip
     *
     * @return $this
     */
    public function setTooltip($tooltip)
    {
        $this->tooltip = $tooltip;

        return $this;
    ***REMOVED***

    /**
     * @param string $markdown
     *
     * @return $this
     */
    public function markdownInfoString($markdown)
    {
        return $this->setMarkdownInfoString($markdown);
    ***REMOVED***

    /**
     * @param string $markdown
     *
     * @return $this
     */
    public function setMarkdownInfoString($markdown)
    {
        $this->markdownInfo = $markdown;

        return $this;
    ***REMOVED***

    /**
     * @param string $file
     *
     * @return $this
     */
    public function markdownInfoFile($file)
    {
        return $this->setMarkdownInfoFile($file);
    ***REMOVED***

    /**
     * @param string $file
     *
     * @return $this
     */
    public function setMarkdownInfoFile($file)
    {
        $path = Markdown::getMarkDownPath($file);
        if (!isset($path)) {
            return $this;
        ***REMOVED***

        $this->markdownInfo = file_get_contents($path);

        return $this;
    ***REMOVED***

    /**
     * @return String
     */
    public function getMarkdownInfo()
    {
        return $this->markdownInfo;
    ***REMOVED***

    /**
     * @param bool $bool
     */
    public function setFolded($bool)
    {
        $this->folded = $bool;
    ***REMOVED***

    /**
     * @return bool
     */
    public function isFolded()
    {
        return $this->folded;
    ***REMOVED***

    /**
     * @return string|null
     */
    public function getSubmitValue()
    {
        $update = $this->getFormAl()->updatedValues();

        return array_key_exists($this->getName(), $update)
            ? $update[$this->getName()] : null;
    ***REMOVED***

    /**
     * @return bool
     */
    private function runValidators()
    {
        $this->errors = [];
        foreach ($this->validators as $validator) {
            $value = $this->getValue();
            if ($validator->validateInput($value, $this) == false) {
                return false;
            ***REMOVED***
        ***REMOVED***

        return true;
    ***REMOVED***

    /**
     * @return $this
     */
    public function notNull()
    {
        $this->addValidator(new Validators\NotNull());

        return $this;
    ***REMOVED***

    /**
     * @param string $title
     * @param string $text
     * @param string $type
     */
    public function error($title, $text, $type = 'error')
    {
        $fieldname = $this->getLabel();
        $msg = "In het veld '" . $fieldname
            . "' is een fout opgetreden!<br/>\n";
        $msg .= "<strong>" . $title . "</strong> " . $text . " <br/>\n";
        $this->errors[] = [
            "type"  => $type,
            "title" => $title,
            "text"  => $text,
            "name"  => $fieldname,
            "msg"   => $msg
        ];
    ***REMOVED***

    /**
     * @param string $title
     * @param string $text
     */
    public function warning($title, $text)
    {
        $this->error($title, $text, 'warning');
    ***REMOVED***

    /**
     * @return array
     */
    public function getErrors()
    {
        if (!empty($this->errors) || !$this->runValidators()) {
            return $this->errors;
        ***REMOVED***

        return [];
    ***REMOVED***

    /**
     * default implementation
     *
     * @param array $options
     *
     * @return false
     */
    public function setOptions($options)
    {
        return false;
    ***REMOVED***

    /**
     * default implementation
     *
     * @return String
     */
    public function getOptions()
    {
        return "";
    ***REMOVED***

    /**
     * @return array
     */
    public function serialize()
    {
        $widget = [];
        $widget['Label'] = $this->getLabel();

        $reflect = new \ReflectionClass($this);
        $widget['FormalObj'] = strtolower($reflect->getShortName());

        $widget['Options'] = json_encode(
            $this->getOptions(),
            JSON_UNESCAPED_UNICODE
        );

        return $widget;
    ***REMOVED***

    /**
     * @param array  $object
     * @param FormAl $formal
     * @param array  $autoCompleteOptions
     *
     * @return ElementBase
     */
    public static function deserialize(
        $object,
        $formal,
        $autoCompleteOptions = []
    ) {
        $obj = strtolower($object['FormalObj']);
        $class = $formal->callables[$obj];

        //use objectID for unique widget name
        /** @var ElementBase $widget */
        $widget = new $class($object['Id'], $formal);

        //Apply attributes to widget
        $widget->label($object['Label']);
        if ($obj == 'autocomplete') {
            $widget->setOptions($autoCompleteOptions);
        ***REMOVED*** else {
            $widget->setOptions(json_decode($object['Options'], true));
        ***REMOVED***

        return $widget;
    ***REMOVED***

    public function isValid()
    {

    ***REMOVED***

    /**
     * Disable the browsers autofill
     *
     * @return $this
     */
    public function disableAutoFill()
    {
        $this->hasAutoFill = false;
        return $this;
    ***REMOVED***
***REMOVED***
