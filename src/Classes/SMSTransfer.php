<?php

namespace vcamelot\RouteeTest\Classes;

use vcamelot\RouteeTest\Classes\BaseTransfer;

class SMSTransfer extends BaseTransfer
{
    private $firstName, $lastName, $phone;

    public function __construct($first_name, $last_name, $phone) {
        $this->firstName = $first_name;
        $this->lastName = $last_name;
        $this->phone = $phone;
    }

    public function send()
    {

    }
}
