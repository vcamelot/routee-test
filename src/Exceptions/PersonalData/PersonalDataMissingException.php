<?php

namespace vcamelot\RouteeTest\Exceptions\PersonalData;

use Exception;

class PersonalDataMissingException extends Exception
{
    /**
     * Throws an exception when some parameters of the Notification class constructor
     * were assigned empty values
     *
     * @param array          $vars
     * @param int            $code
     * @param Exception|null $previous
     */
    public function __construct($vars, $code = 0, Exception $previous = null)
    {
        parent::__construct("Notification class constructor parameters cannot be empty: "
            . implode(",", $vars), $code, $previous);
    }
}
