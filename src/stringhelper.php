<?php

/**
 * Description of StringHelper
 *
 * @author lpp
 */
class StringHelper {

    public function getLengthOfString($productName)
    {
        return mb_strlen($productName, 'UTF-8');
    }

}
