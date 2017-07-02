<?php
namespace FormAl;

/**
 * Class FormAlAbstract
 *
 * @package FormAl
 */
abstract class FormAlAbstract
{
    /** @var string */
    private $uniquename;
    /** @var ElementBase[] */
    private $elements = [];
    /** @var int */
    private $phase = 0;
    /** @var array */
    public $callables = [];
    const PHASE_SETUP = 0;
    const PHASE_USAGE = 1;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->uniquename = $name;
    }

    /**
     * @return string
     */
    final public function getName()
    {
        return preg_replace("/[^a-zA-Z0-9-]+/", "_", $this->uniquename);
    }

    /**
     * @param string $uniquename
     */
    public function setName($uniquename)
    {
        $this->uniquename = preg_replace("/[^a-zA-Z0-9-]+/", "_", $uniquename);
    }

    /**
     * @param ElementBase $element
     *
     * @throws \Exception
     */
    public function addElement(ElementBase $element)
    {
        if ($this->phase != self::PHASE_SETUP) {
            throw new \Exception("Setup phase has ended", 1);
        }

        $this->elements[] = $element;
    }

    /**
     * @return string
     */
    public function exportForm()
    {
        return serialize($this);
    }

    /**
     * @param string $value
     *
     * @return mixed
     */
    public function importForm($value)
    {
        return unserialize($value);
    }

    /**
     * @return array
     */
    public function export()
    {
        if ($this->phase == self::PHASE_SETUP) {
            $this->phase = self::PHASE_USAGE;
        }
        $out = [];
        foreach ($this->elements as $element) {
            if ($element->markForExport == true) {
                $name = $element->getUniqueName();
                $value = $element->getValue();
                if (empty($value)) {
                    $value = null;
                }
                $out[$name] = $value;
            }
        }

        return $out;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        $errors = [];
        foreach ($this->elements as $el) {
            foreach ($el->getErrors() as $e) {
                $errors[] = $e;
            }
        }

        return $errors;
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return count($this->getErrors()) > 0;
    }

    /**
     * @return bool
     */
    public function hasNoErrors()
    {
        return !$this->hasErrors();
    }

    /**
     * @return array
     */
    public function updatedValues()
    {
        return [];
    }

    /**
     * @param array $data
     *
     * @throws \Exception
     */
    public function import($data)
    {
        if (is_array($data)) {
            foreach ($this->elements as $el) {
                //echo $el->getUniqueName() . "<br>";
                if (isset($data[$el->getUniqueName()])) {
                    $el->setValue($data[$el->getUniqueName()]);
                }
            }
        } else {
            throw new \Exception("Form-Al Import is not using an array", 1);
        }
    }

    /**
     * @return ElementBase[]
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * @param string $name
     *
     * @return ElementBase
     * @throws \Exception
     */
    public function getElement($name)
    {
        foreach ($this->elements as $element) {
            if ($element->getUniqueName() == $name) {
                return $element;
            }
        }
        throw new \Exception("This element does not exist", 1);
    }

    /**
     * @param string $type
     *
     * @return ElementBase
     * @throws \Exception
     */
    public function getElementsByType($type)
    {
        foreach ($this->elements as $element) {
            if (stristr(get_class($element), $type) !== false) {
                return $element;
            }
        }
        throw new \Exception("This element does not exist", 1);
    }

    abstract public function render();

    /**
     * @return $this
     */
    public function getAbstract()
    {
        return $this;
    }

    /**
     * @param string $name
     * @param array  $args
     *
     * @return ElementBase
     * @throws \Exception
     */
    public function __call($name, $args)
    {
        if (isset($this->callables[$name])) {
            $className = $this->callables[$name];
            $args[0] = isset($args[0]) ? $args[0] : false;
            if (count($args) == 0) {
                $element = new $className($this);
            } elseif (count($args) == 1) {
                $element = new $className($args[0], $this);
            } elseif (count($args) == 2) {
                $element = new $className($args[0], $args[1], $this);
            } elseif (count($args) == 3) {
                $element = new $className($args[0], $args[1], $args[2], $this);
            } else {
                throw new \Exception("invalid amount of arguments in $name");
            }

            $this->addElement($element);

            return $element;
        } else {
            throw new \Exception(
                "The function $name is not found on this class"
            );
        }
    }
}
