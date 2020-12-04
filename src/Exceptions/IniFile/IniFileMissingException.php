<?php

namespace vcamelot\RouteeTest\Exceptions\IniFile;

use Exception;

class IniFileMissingException extends Exception
{
    /**
     * Throws an exception when the .INI file was not found
     *
     * @param array          $vars
     * @param int            $code
     * @param Exception|null $previous
     */
    public function __construct($message = ".INI file not found", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
