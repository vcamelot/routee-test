<?php

namespace vcamelot\RouteeTest\Exceptions\WeatherMap;

use Exception;

class MapAPIException extends Exception
{
    /**
     * Throws an exception when call to OpenWeather API did not return successful code
     *
     * @param string         $message
     * @param int            $code
     * @param Exception|null $previous
     */
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct(
            "The call to OpenWeather API resulted in error: " . $message,
            $code,
            $previous
        );
    }
}
