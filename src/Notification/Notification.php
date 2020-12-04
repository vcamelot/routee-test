<?php

namespace vcamelot\RouteeTest\Notification;

use vcamelot\RouteeTest\Classes\IniVars;

class Notification
{
    /**
     * Test INI file, validate personal data
     * 
     * @param string $first_name
     * @param string $last_name
     * @param string $phone
     * @return void     
     */
    public function __construct($first_name, $last_name, $phone)
    {
        IniVars::testINIFile();
        IniVars::savePersonalData($first_name, $last_name, $phone);
    }

    /**
     * Initiate notification procedure
     */
    public function run()
    {
    }
}
