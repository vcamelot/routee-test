<?php

namespace vcamelot\RouteeTest\Notification;

use Exception;
use vcamelot\RouteeTest\Classes\IniVars;
use vcamelot\RouteeTest\Classes\Weather;
use vcamelot\RouteeTest\Classes\SMSTransfer;

class Notification
{
    private $firstName, $lastName, $phone;
    private $errorMessage;

    /**
     * Save first name, last name, phone
     * 
     * @param string $first_name
     * @param string $last_name
     * @param string $phone
     * @return void     
     */
    public function __construct($first_name, $last_name, $phone)
    {
        $this->firstName = $first_name;
        $this->lastName = $last_name;
        $this->phone = $phone;

        $errorMessage = 'No error';
    }

    /**
     * Test and validate input data. Run notification procedure.
     * 
     * @return bool
     */
    public function run()
    {
        try {
            IniVars::testINIFile();
            IniVars::savePersonalData($this->firstName, $this->lastName, $this->phone);    

            $weather = new Weather();
            $temp = $weather->getTemperature();
            echo $temp;

            $transfer = new SMSTransfer($this->firstName, $this->lastName, $this->phone);
            $transfer->send();
        }
        catch(Exception $e) {
            $this->errorMessage = $e->getMessage();
            return false;
        }

        return true;
    }

    /**
     * Return last error message
     * 
     * @return string
     */
    public function getLastError() {
        return $this->errorMessage;
    }
}
