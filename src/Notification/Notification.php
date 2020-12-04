<?php

namespace vcamelot\RouteeTest\Notification;

use vcamelot\RouteeTest\Classes\IniVars;
use vcamelot\RouteeTest\Exceptions\PersonalData\PersonalDataMissingException;

class Notification
{

    private $firstName, $lastName, $phone;

    /**
     * Validate personal data and save in class instance
     * 
     * @param string $first_name
     * @param string $last_name
     * @param string $phone
     * @return void
     * @throws PersonalDataMissingException
     */
    public function __construct($first_name, $last_name, $phone)
    {
        $arg_list = get_defined_vars();
        $empty_args = [];
        foreach ($arg_list as $key => $value) {
            if (empty($value)) {
                $empty_args[] = $key;
            }
        }
        if (!empty($empty_args)) {
            throw new PersonalDataMissingException($empty_args);
        }

        IniVars::test();

        $this->firstName = $first_name;
        $this->lastName = $last_name;
        $this->phone = $phone;
    }

    /**
     * Initiate notification procedure
     */
    public function run()
    {
    }
}
