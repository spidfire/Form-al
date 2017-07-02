***REMOVED***

namespace FormAl\Utilities;

/**
 * Class HtmlBuilder
 *
 * @package FormAl\Utilities
 */
class HtmlBuilder
{
    /** @var string */
    private $name = '';
    /** @var array */
    private $attr = [];
    /** @var array */
    private $add = [];

    /**
     * @param string $name
     *
     * @return HtmlBuilder
     */
    public static function create($name)
    {
        return new self($name);
    ***REMOVED***

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        //automatic class attribute creation
        if (strstr($name, ".")) {
            list($name, $classes) = explode(".", $name, 2);
            if (!empty($classes)) {
                $this->attr("class", str_replace('.', ' ', $classes));
            ***REMOVED***
        ***REMOVED***
        $this->name = htmlspecialchars($name);
    ***REMOVED***

    /**
     * @param string $name
     * @param string $value
     *
     * @return $this
     */
    public function attr($name, $value)
    {
        if ($value !== null) {
            $this->attr[$name] = $value;
        ***REMOVED***

        return $this;
    ***REMOVED***

    /**
     * @param string $value
     *
     * @return $this
     */
    public function addClass($value)
    {
        if (isset($this->attr['class'])) {
            $this->attr['class'] = $this->attr['class'] . " " . $value;

        ***REMOVED*** else {
            $this->attr['class'] = $value;
        ***REMOVED***

        return $this;
    ***REMOVED***

    /**
     * @param array|string $style
     *
     * @return $this
     * @throws \Exception
     */
    public function style($style)
    {
        if (is_array($style)) {
            $concattedstyle = "";
            foreach ($style as $key => $value) {
                $concattedstyle[] = $key . ":" . $value;
            ***REMOVED***
            $concattedstyle = implode(";", $concattedstyle);
            $this->attr('style', $concattedstyle);
        ***REMOVED*** elseif (is_string($style)) {
            $this->attr('style', $style);
        ***REMOVED*** else {
            throw new \Exception("Unkown type for style in HtmlBuilder", 1);

        ***REMOVED***

        return $this;

    ***REMOVED***

    /**
     * @return $this
     */
    public function nl()
    {
        $this->addHtml("<br/>\n");

        return $this;
    ***REMOVED***

    /**
     * @param string $name
     *
     * @return HtmlBuilder
     */
    public function add($name)
    {
        $element = new HtmlBuilder($name);

        $this->add[] = ['type' => 'htmlbuilder', 'data' => $element];

        return $element;
    ***REMOVED***

    /**
     * @param string $text
     *
     * @return $this
     */
    public function addText($text)
    {
        $this->add[] = ['type' => 'text', 'data' => $text];

        return $this;
    ***REMOVED***

    /**
     * @param string $text
     *
     * @return $this
     */
    public function addHtml($text)
    {
        $this->add[] = ['type' => 'html', 'data' => $text];

        return $this;
    ***REMOVED***

    /**
     * @param array $variables
     *
     * @return string
     * @throws \Exception
     */
    public function template($variables = [])
    {
        $html = $this->render();
        foreach ($variables as $key => $value) {
            $html = preg_replace("/{{\s*" . $key . "\s****REMOVED******REMOVED***/is", $value, $html);
        ***REMOVED***

        return $html;
    ***REMOVED***

    /**
     * @return string
     */
    public function jsHtml()
    {
        $html = "$('<" . $this->name . "/>')\n";
        $html .= ".attr(" . json_encode($this->attr) . ")\n";
        if (count($this->add) > 0) {
            foreach ($this->add as $el) {
                switch ($el['type']) {
                    case 'htmlbuilder':
                        /** @var HtmlBuilder $data */
                        $data = $el['data'];
                        $html .= ".append(" . $data->jsHtml() . ")\n";
                        break;
                    case 'html':
                        $html .= ".append(" . json_encode($el['data']) . ")\n";
                        break;
                    case 'text':
                        $html .= ".append($(" . json_encode($el['data'])
                            . ").text())\n";
                        break;
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***

        return $html;
    ***REMOVED***

    /**
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        $html = "<" . $this->name;

        foreach ($this->attr as $key => $value) {
            if (is_array($value)) {
                throw new \Exception(
                    "The value of the attribute '$key' is an array!",
                    1
                );
            ***REMOVED*** elseif (!is_null($value)) {
                $html .= " " . $key . "=\"" . htmlentities($value) . "\"";
            ***REMOVED***
        ***REMOVED***

        if (count($this->add) > 0) {
            $html .= ">";
            foreach ($this->add as $el) {
                switch ($el['type']) {
                    case 'htmlbuilder':
                        /** @var HtmlBuilder $data */
                        $data = $el['data'];
                        $html .= $data->render() . "\n";
                        break;
                    case 'html':
                        $html .= $el['data'] . "\n";
                        break;
                    case 'text':
                        $html .= htmlspecialchars($el['data']);
                        break;
                ***REMOVED***
            ***REMOVED***

            $html .= "</" . $this->name . ">";
        ***REMOVED*** else {
            $singletags = ['input'];
            if (in_array($this->name, $singletags)) {
                $html .= "/>";
            ***REMOVED*** else {
                $html .= "></" . $this->name . ">";
            ***REMOVED***


        ***REMOVED***

        return $html;
    ***REMOVED***
***REMOVED***
