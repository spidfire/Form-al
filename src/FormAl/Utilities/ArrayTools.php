***REMOVED***

namespace FormAl\Utilities;

/**
 * Class ArrayTools
 *
 * @package FormAl\Utilities
 */
class ArrayTools
{
    /**
     * @param array $array
     *
     * @return bool
     */
    public static function isAssoc($array)
    {
        return (array_values($array) !== $array);
    ***REMOVED***

    /**
     * @param array $array
     *
     * @return bool
     */
    public static function isNotAssoc($array)
    {
        return !self::isAssoc($array);
    ***REMOVED***
***REMOVED***
