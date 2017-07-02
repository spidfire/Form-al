<?php

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
    }

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
            }
        }
        $this->name = htmlspecialchars($name);
    }

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
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function addClass($value)
    {
        if (isset($this->attr['class'])) {
            $this->attr['class'] = $this->attr['class'] . " " . $value;

        } else {
            $this->attr['class'] = $value;
        }

        return $this;
    }

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
            }
            $concattedstyle = implode(";", $concattedstyle);
            $this->attr('style', $concattedstyle);
        } elseif (is_string($style)) {
            $this->attr('style', $style);
        } else {
            throw new \Exception("Unkown type for style in HtmlBuilder", 1);

        }

        return $this;

    }

    /**
     * @return $this
     */
    public function nl()
    {
        $this->addHtml("<br/>\n");

        return $this;
    }

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
    }

    /**
     * @param string $text
     *
     * @return $this
     */
    public function addText($text)
    {
        $this->add[] = ['type' => 'text', 'data' => $text];

        return $this;
    }

    /**
     * @param string $text
     *
     * @return $this
     */
    public function addHtml($text)
    {
        $this->add[] = ['type' => 'html', 'data' => $text];

        return $this;
    }

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
            $html = preg_replace("/{{\s*" . $key . "\s*}}/is", $value, $html);
        }

        return $html;
    }

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
                }
            }
        }

        return $html;
    }

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
            } elseif (!is_null($value)) {
                $html .= " " . $key . "=\"" . htmlentities($value) . "\"";
            }
        }

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
                }
            }

            $html .= "</" . $this->name . ">";
        } else {
            $singletags = ['input'];
            if (in_array($this->name, $singletags)) {
                $html .= "/>";
            } else {
                $html .= "></" . $this->name . ">";
            }


        }

        return $html;
    }
}
