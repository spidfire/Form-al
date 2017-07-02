***REMOVED***

namespace FormAl\Elements;

use FormAl\ElementBase;

/**
 * Class Text
 *
 * @package FormAl\Elements
 */
class Markdown extends ElementBase
{
    /** @var string */
    public $value = null;
    /** @var bool */
    public $fullWidth = false;
    /** @var bool */
    public $markForExport = false;
    /** @var string */
    public $text = "You need to set this text with using ->setByFile() or ->setByString()";

    /**
     * @return bool
     */
    public function isClicked()
    {
        $updateArray = $this->getFormAl()->updatedValues();
        $name = md5($this->getName());

        return isset($updateArray[$name]);
    ***REMOVED***

    /**
     * @param string $md
     *
     * @return $this
     */
    public function setByString($md)
    {
        $parse = new \Parsedown();
        $md = addslashes($md);
        $this->text = $parse->text($md);
        return $this;
    ***REMOVED***

    /**
     * @param bool $bool
     */
    public function setFullWidth($bool)
    {
        $this->fullWidth = $bool;
    ***REMOVED***

    /**
     * @return string
     */
    public function render()
    {
        return $this->text;
    ***REMOVED***
***REMOVED***
