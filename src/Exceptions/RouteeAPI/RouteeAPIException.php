<?php

namespace vcamelot\RouteeTest\Exceptions\RouteeAPI;

use Exception;

class RouteeAPIException extends Exception
{
    /**
     * Throws an exception when call to Routee API did not return successful code
     *
     * @param string         $message
     * @param int            $code
     * @param Exception|null $previous
     */
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct(
            "The call to Routee API resulted in error: " . $message,
            $code,
            $previous
        );
    }
}