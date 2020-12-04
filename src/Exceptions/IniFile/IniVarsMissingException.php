<?php

namespace vcamelot\RouteeTest\Exceptions\IniFile;

use Exception;

class IniVarsMissingException extends Exception
{
    /**
     * Throws an exception when some variables were assigned null value
     *
     * @param array          $vars
     * @param int            $code
     * @param Exception|null $previous
     */
    public function __construct($vars, $code = 0, Exception $previous = null)
    {
        parent::__construct("The following .INI vars are not defined: "
            . implode(",", $vars), $code, $previous);
    }
}