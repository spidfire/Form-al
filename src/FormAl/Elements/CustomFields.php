***REMOVED***

namespace FormAl\Elements;

use FormAl\Utilities\HtmlBuilder;

/**
 * Class CustomFields
 *
 * @package FormAl\Elements
 */
class CustomFields extends Input
{
    public $emptyfields = 4;
    public $buttonText = "";
    public $extraFields = [];

    /**
     * @param string $name
     * @param string $placeholder
     *
     * @return $this
     */
    public function addField($name, $placeholder)
    {
        $this->extraFields[] = [
            "name"        => $name,
            "placeholder" => $placeholder,
        ];

        return $this;
    ***REMOVED***

    /**
     * @param string $text
     *
     * @return $this
     */
    public function setButtonText($text)
    {
        $this->buttonText = $text;

        return $this;
    ***REMOVED***

    /**
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        $element = new HtmlBuilder('div');
        $uniquename = 'autocompete_' . md5($this->getName());
        $items = is_array($this->getValue()) ? $this->getValue() : [];
        $element->add('ol')
            ->attr('class', 'autocompleteholder')
            ->attr('id', $uniquename . '_holder');
        $jsexec = [];
        foreach ($items as $value) {
            $jsexec[] = $uniquename . "add(" . json_encode($value) . ");";
        ***REMOVED***

        $element->add('div')->attr('id', '' . $uniquename . '_autocompl');
        $element->add('button.btn.btn-primary')
            ->attr('type', 'button')
            ->addText($this->buttonText)
            ->attr('onclick', '' . $uniquename . 'add({***REMOVED***)');
        $element->add('noscript')->addText(
            "Sorry this function needs Javascript to work!"
        );
        $element->nl();

        $script = $element->add('script');

        $extraFieldData = "";

        // adds an field to the js
        if (count($this->extraFields) > 0) {
            foreach ($this->extraFields as $field) {
                $extraFieldData
                    .= 'lihtml.append(" "); lihtml.append($("<input/>")
                        .attr({
                          "type": "text",
                          "class": "form-control",
                          "style": "width:40%; display:inline-block",
                          "autocomplete": "off",
                          "name": "' . $this->getName() . '["+id_' . $uniquename
                    . '+"][' . $field['name'] . ']",
                          "placeholder": "' . $field['placeholder'] . '",
                          "value": value["' . $field['name'] . '"] || ""
                        ***REMOVED***));';
            ***REMOVED***
        ***REMOVED*** else {
            $extraFieldData = "You need to add fields";
        ***REMOVED***

        $script->addHtml(
            '
            var  id_' . $uniquename . ' = 0;
            function ' . $uniquename . 'add(value){
                var lihtml = $("<li/>")

                    // lihtml.append(name)
                    ' . $extraFieldData . '

                    var button = "<a href=\"Javascript:void(0)\" onclick=\'$(this).parent().remove()\' > X</a>";

                    lihtml.append(button)



                lihtml = "<li>"+ lihtml.html() + "</li>";
                $("#' . $uniquename . '_holder").html($("#' . $uniquename . '_holder").html() + lihtml)

                id_' . $uniquename . '++;
            ***REMOVED***

            $(function (){
                ' . implode("\n", $jsexec) . '

            ***REMOVED***)
            '
        );

        if (json_last_error() != JSON_ERROR_NONE) {
            throw new \Exception("JSON ERROR: " . json_last_error_msg(), 1);
        ***REMOVED***


        return $element->render();
    ***REMOVED***

    /**
     * @param array|string $dat
     *
     * @return array|string
     */
    public function utf8EncodeAll($dat)
    {
        if (is_string($dat)) {
            return utf8_encode($dat);
        ***REMOVED***
        if (!is_array($dat)) {
            return $dat;
        ***REMOVED***
        $ret = [];
        foreach ($dat as $i => $d) {
            $ret[$i] = $this->utf8EncodeAll($d);
        ***REMOVED***

        return $ret;
    ***REMOVED***

    public function setOptions($array = []){
        $this
            ->setButtonText(trans("Voeg een onbekend lid toe"))
            ->addField("naam", trans("Naam"))
            ->addField("functie", trans("Functie"));
    ***REMOVED***
***REMOVED***
