<?php  namespace LPP\Shopping\Utils;

/**
 * Description of StringHelper
 *
 * @author lpp
 */
class StringHelper
{

    public function getLengthOfString($input)
    {
        if (function_exists('mb_strlen')) {
            return mb_strlen($input, mb_detect_encoding($input));
        } else {
            if (preg_match('!!u', $input)) {
                // this is utf-8
                return strlen(utf8_decode($input));
            } else {
                // not utf-8 so should be ISO-8859-1
                return strlen($input);
            }
        }
    }

}
