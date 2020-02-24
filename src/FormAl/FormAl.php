***REMOVED***

namespace FormAl;

use FormAl\Elements\Autocomplete;
use FormAl\Elements\BinaryCheckboxes;
use FormAl\Elements\Button;
use FormAl\Elements\Checkbox;
use FormAl\Elements\Chosen;
use FormAl\Elements\Colorpicker;
use FormAl\Elements\CustomFields;
use FormAl\Elements\DateNoTimepicker;
use FormAl\Elements\Datepicker;
use FormAl\Elements\FaIconPicker;
use FormAl\Elements\FileUpload;
use FormAl\Elements\FoldGroup;
use FormAl\Elements\Hidden;
use FormAl\Elements\IconUpload;
use FormAl\Elements\ImageUploadToServer;
use FormAl\Elements\Input;
use FormAl\Elements\Integer as IntElement;
use FormAl\Elements\MapLocationRadius;
use FormAl\Elements\Maps;
use FormAl\Elements\Markdown;
use FormAl\Elements\MultiInput;
use FormAl\Elements\MultiSelect;
use FormAl\Elements\Password;
use FormAl\Elements\PositiveInteger;
use FormAl\Elements\Radio;
use FormAl\Elements\RangeInput;
use FormAl\Elements\Select;
use FormAl\Elements\SelectSteps;
use FormAl\Elements\Submit;
use FormAl\Elements\Text;
use FormAl\Elements\Textarea;
use FormAl\Elements\Title;
use FormAl\Elements\URL;
use FormAl\Utilities\HtmlBuilder;

/**
 * Class FormAl
 * @method Autocomplete autocomplete(string $name = false, array $args = [])
 * @method Checkbox checkbox(string $name = false, array $args = [])
 * @method Radio radio(string $name = false, array $args = [])
 * @method Textarea textarea(string $name = false, array $args = [])
 * @method MultiSelect multiselect(string $name = false, array $args = [])
 * @method MultiInput multiinput(string $name = false, array $args = [])
 * @method FileUpload fileupload(string $name = false, array $args = [])
 * @method RangeInput rangeinput(string $name = false, array $args = [])
 * @method Datepicker datepicker(string $name = false, array $args = [])
 * @method DateNoTimepicker datenotimepicker(string $name = false, array $args = [])
 * @method BinaryCheckboxes binarycheckboxes(string $name = false, array $args = [])
 * @method ImageUploadToServer imageuploadserver(string $name = false, array $args = [])
 * @method SelectSteps selectsteps(string $name = false, array $args = [])
 * @method Input input(string $name = false, array $args = [])
 * @method Password password(string $name = false, array $args = [])
 * @method Select select(string $name = false, array $args = [])
 * @method Submit submit(string $name = false, array $args = [])
 * @method Text text(string $name = false, array $args = [])
 * @method Title title(string $name = false, array $args = [])
 * @method CustomFields customfields(string $name = false, array $args = [])
 * @method Colorpicker colorpicker(string $name = false, array $args = [])
 * @method Hidden hidden(string $name = false, array $args = [])
 * @method IconUpload iconupload(string $name = false, array $args = [])
 * @method URL url(string $name = false, array $args = [])
 * @method IntElement integer(string $name = false, array $args = [])
 * @method PositiveInteger positiveinteger(string $name = false, array $args = [])
 * @method Maps maps(string $name = false, array $args = [])
 * @method Chosen chosen(string $name = false, array $args = [])
 * @method Button button(string $name = false, array $args = [])
 * @method MapLocationRadius mapLocationRadius(string $name = false, array $args = [])
 * @method Markdown markdown(string $name = false, array $args = [])
 * @method FoldGroup foldgroup(string $name = false, array $args = [])
 * @method FaIconPicker faiconpicker(string $name = false, array $args = [])
 *
 * @package FormAl
 */
class FormAl extends FormAlAbstract
{
    const SHOW_ERRORS = true;
    const HIDE_ERRORS = false;
    /** @var bool */
    public $useTabs = true;
    /** @var int */
    public $tabCount = 0;
    /** @var null|string */
    public $confirmtext = null;
    /** @var bool */
    public $showOptionalChecks = false;
    /** @var string */
    public $optionalChecksText
        = "If you check this box the value will be used otherwise the value of the parent will be used";
    /** @var array */
    public $callables
        = [
            "checkbox"            => "\FormAl\Elements\Checkbox",
            "radio"               => "\FormAl\Elements\Radio",
            "textarea"            => "\FormAl\Elements\Textarea",
            "multiselect"         => "\FormAl\Elements\MultiSelect",
            "multiinput"          => "\FormAl\Elements\MultiInput",
            "imageupload"         => "\FormAl\Elements\ImageUpload",
            "fileupload"          => "\FormAl\Elements\FileUpload",
            "wysiwyg"             => "\FormAl\Elements\Wysiwyg",
            "table"               => "\FormAl\Elements\Table",
            "jsoneditor"          => "\FormAl\Elements\JsonEditor",
            "range"               => "\FormAl\Elements\Range",
            "rangeinput"          => "\FormAl\Elements\RangeInput",
            "datepicker"          => "\FormAl\Elements\Datepicker",
            "datenotimepicker"    => "\FormAl\Elements\DateNoTimepicker",
            "binarycheckboxes"    => "\FormAl\Elements\BinaryCheckboxes",
            "imageuploadserver"   => "\FormAl\Elements\ImageUploadToServer",
            "imageuploadtoserver" => "\FormAl\Elements\ImageUploadToServer",
            "selectsteps"         => "\FormAl\Elements\SelectSteps",
            "input"               => "\FormAl\Elements\Input",
            "phoneNumber"         => "\FormAl\Elements\PhoneNumber",
            "postalCode"          => "\FormAl\Elements\PostalCode",
            "password"            => "\FormAl\Elements\Password",
            "select"              => "\FormAl\Elements\Select",
            "autocomplete"        => "\FormAl\Elements\Autocomplete",
            "submit"              => "\FormAl\Elements\Submit",
            "text"                => "\FormAl\Elements\Text",
            "title"               => "\FormAl\Elements\Title",
            "customfields"        => "\FormAl\Elements\CustomFields",
            "colorpicker"         => "\FormAl\Elements\Colorpicker",
            "hidden"              => "\FormAl\Elements\Hidden",
            "iconupload"          => "\FormAl\Elements\IconUpload",
            "url"                 => "\FormAl\Elements\URL",
            "integer"             => "\FormAl\Elements\Integer",
            "positiveinteger"     => "\FormAl\Elements\PositiveInteger",
            "maps"                => "\FormAl\Elements\Maps",
            "chosen"              => "\FormAl\Elements\Chosen",
            "button"              => "\FormAl\Elements\Button",
            "mapLocationRadius"   => "\FormAl\Elements\MapLocationRadius",
            "markdown"            => "\FormAl\Elements\Markdown",
            "foldgroup"           => "\FormAl\Elements\FoldGroup",
            "faiconpicker"        => "\FormAl\Elements\FaIconPicker",
        ];


    /**
     * @param bool|true $showErrors
     *
     * @return string
     * @throws \Exception
     */
    public function render($showErrors = true)
    {
        $form = HtmlBuilder::create('form')
            ->attr('method', 'POST')
            ->attr('id', $this->getName())
            ->attr(
                'class',
                'form-horizontal approvalform form-bordered'
            )
            ->attr('enctype', "multipart/form-data")
			->attr('autocomplete', 'off');

        if (!is_null($this->confirmtext)) {
            $form->attr(
                'onsubmit',
                'return window.confirm(' . json_encode($this->confirmtext)
                . ');'
            );
        ***REMOVED***

        foreach ($this->getElements() as $el) {
            $this->renderElement($form, $el, $showErrors);
        ***REMOVED***

        if ($this->tabCount > 0) {
            $form->addHtml("</section>");
            $form->addHtml("<script>");
            $form->addHtml("$('#" . $this->getName() . "').easyWizard();");
            $form->addHtml("</script>");
        ***REMOVED***

        //remove border on small devices
        $form->addHtml(
            "<script>
            var small = false;
            bordered();
            $(window).resize(function() {
                bordered();
            ***REMOVED***);
            function bordered() {
                if ($(window).width() < 768 && small == false) {
                    $('form').removeClass('form-bordered');
                    small = true;
                ***REMOVED*** else if($(window).width() > 768 && small == true) {
                    $('form').addClass('form-bordered');
                    small = false;
                ***REMOVED***
            ***REMOVED***
            </script>");
        return $form->render();
    ***REMOVED***

    /**
     * @param HtmlBuilder $parent
     * @param ElementBase $element
     * @param bool        $showErrors
     */
    private function renderElement($parent, $element, $showErrors)
    {
        /** @var ElementBase $element */
        if ($this->useTabs == true && $element instanceof Elements\Title) {
            /** @var Elements\Title $element */
            if ($this->tabCount > 0) {
                $parent->addHtml("</section>");
            ***REMOVED***

            $parent->addHtml(
                "<section class='step' data-step-title=\"" . htmlentities(
                    $element->text
                ) . "\">"
            );
            $this->tabCount++;
        ***REMOVED*** elseif ($element instanceof Elements\FoldGroup) {
            /** @var FoldGroup $element */
            $this->renderFoldGroup($element, $parent);
        ***REMOVED*** else {
            if ($element instanceof Submit) {
                $holder = $parent->add('div.form-actions.col-sm-offset-3.col-sm-9 formal-submit-element row.form-group.' . $element->getName());
                if ($element->isFolded()) {
                    $holder->style("display:none;");
                ***REMOVED***
            ***REMOVED*** elseif ($element instanceof Markdown) {
                $div = $parent->add('div.row.form-group.' . $element->getName());
                if ($element->isFolded()) {
                    $div->style("display:none;");
                ***REMOVED***

                if ($element->usesFullWidth()) {
                    $holder = $div->add('div.col-sm-offset-0');
                ***REMOVED*** else {
                    $holder = $div->add('div.col-sm-offset-3');
                ***REMOVED***
            ***REMOVED*** elseif ($element->usesFullWidth()) {
                $div = $parent->add('div.row.form-group.' . $element->getName());
                if ($element->isFolded()) {
                    $div->style("display:none;");
                ***REMOVED***

                $holder = $div->add('div.col-sm');
            ***REMOVED*** else {
                $div = $parent->add(
                    'div.row.form-group.' . $element->getName()
                );
                if ($element->isFolded()) {
                    $div->style("display:none;");
                ***REMOVED***
                $label = $div->add('label.col-sm-3.control-label')
                    ->addText($element->getLabel());
                $label->attr("id", 'i' . $element->getName());
                $label->attr("title", $element->getTooltip());
                $label->style("text-align:right;");

                $this->renderMarkdownInfo($element, $label);

                if ($this->showOptionalChecks) {
                    $check = $label->add('div.check-usage')->attr(
                        'style',
                        'background-color:#faa;'
                    );
                    $used = isset($_POST[$element->getName() . "_is_used"]);
                    $check->add('input')
                        ->attr('type', 'checkbox')
                        ->attr('name', $element->getName() . "_is_used")
                        ->attr(
                            'checked',
                            $used ? "checked" : null
                        )
                        ->attr('value', 'checked');

                    $check->addHtml($this->optionalChecksText);
                ***REMOVED***

                $holder = $div->add('div.col-sm-9');
            ***REMOVED***

            if ($showErrors) {
                foreach ($element->getErrors() as $err) {
                    $holder->add('div.alert.alert-danger')
                        ->style('')
                        ->addHtml(
                            "<strong>" . $err['title'] . "</strong> - "
                            . $err['text']
                        );
                ***REMOVED***
            ***REMOVED***
            // $form->nl();
            $holder->addHtml($element->render());
        ***REMOVED***
    ***REMOVED***

    /**
     * @param FoldGroup   $foldgroup
     * @param HtmlBuilder $parent
     */
    private function renderFoldGroup($foldgroup, $parent)
    {
        $row = $parent->add('div');

        // add small bar
        $div = $row->add('div.col-sm-6 more-options.' . $foldgroup->getName());
        $div->attr("id", "navigation");
        $div->addHtml("+ " . $foldgroup->getLabel());

        // Javascript to toggle all elements
        $jsName = "$('." . $foldgroup->getName() . "')";

        $row->addHtml("<script>");
        $row->addHtml($jsName . ".on('click', function() {");
        foreach ($foldgroup->getElements() as $subEl) {
            // Add slideToggle to each element in foldgroup
            $row->addHtml("$('." . $subEl->getName() . "').slideToggle();");
        ***REMOVED***
        // Change + into -
        $row->addHtml("var str = " . $jsName . ".text();");
        $row->addHtml(
            "if (str.charAt(0) == '+') str = str.replace('+', '-'); "
        );
        $row->addHtml("else str = str.replace('-', '+');");
        $row->addHtml($jsName . ".html(str);");

        $row->addHtml("***REMOVED***);");

        if(!empty($this->updatedValues()) && $this->hasErrors()){
            $row->addHtml('
            $( window ).load(function() {
                $( ".' . $foldgroup->getName() . '" ).trigger( "click" );
            ***REMOVED***);
            ');
        ***REMOVED***

        $row->addHtml("</script>");
    ***REMOVED***

    /**
     * @param ElementBase $element
     * @param HtmlBuilder $label
     */
    private function renderMarkdownInfo($element, $label)
    {
        // render markdown info
        if ($element->getMarkdownInfo() != "") {
            $label->addHtml(
                '<i class="fa fa-info-circle fa-1x" style="float:right;padding-left:2px;padding-top:4px;"></i>'
            );

            $parse = new \Parsedown();
            $md = addslashes($element->getMarkdownInfo());
            $text = $parse->text($md);
            $text = str_replace("\n", "", $text);

            $label->addHtml(
                '
                <script>
                $(document).ready(function () {
                $( "#i' . $element->getName() . '" ).tooltip({
                    content: \'' . $text . '\',
                    position: { collision: "flipfit" ***REMOVED***
                ***REMOVED***);
                ***REMOVED***);
                </script>
            '
            );
        ***REMOVED***
    ***REMOVED***

    /**
     * @return array
     */
    public function updatedValues()
    {
        return array_merge(parent::updatedValues(), $_POST);
    ***REMOVED***
***REMOVED***
