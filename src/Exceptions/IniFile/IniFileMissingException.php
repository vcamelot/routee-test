<?php

namespace Routee\DVTest\Exceptions\IniFile;

class IniFileMissingException extends \Exception
{
    public function __construct($message = ".INI file not found", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}