<?php

namespace vcamelot\RouteeTest\Classes;

use vcamelot\RouteeTest\Exceptions\IniFile\IniFileMissingException;
use vcamelot\RouteeTest\Exceptions\IniFile\IniVarsMissingException;
use vcamelot\RouteeTest\Exceptions\IniFile\IniVarsEmptyException;
use vcamelot\RouteeTest\Exceptions\PersonalData\PersonalDataMissingException;

class IniVars
{
    private static $iniVarsExpected = [
        "openweather_api_key", "routee_app_id", "routee_app_secret"
    ];
    private static $openWeatherAPIKey, $routeeAppId, $routeeAppSecret;

    public static $firstName, $lastName, $phone;

    public static function getAPIKey()
    {
        return self::$openWeatherAPIKey;
    }

    public static function getAppId()
    {
        return self::$routeeAppId;
    }

    public static function getAppSecret()
    {
        return self::$routeeAppSecret;
    }

    /**
     * Check .INI file presence. Check correct names of .INI variables. Check that there are no unassigned variables.
     *
     * @return bool
     * @throws IniFileMissingException
     * @throws IniVarsMissingException
     * @throws IniVarsEmptyException
     */
    public static function testINIFile()
    {
        // Check presence of the .INI file
        if (!file_exists('test.ini')) {
            throw new IniFileMissingException();
        }

        // Check that all .INI variables are present
        $ini_vars_actual = parse_ini_file("test.ini");
        $ini_vars_diff = array_diff(self::$iniVarsExpected, array_keys($ini_vars_actual));
        if (!empty($ini_vars_diff)) {
            throw new IniVarsMissingException($ini_vars_diff);
        }

        // Check that all .INI variables are initialized
        $ini_vars_empty = [];
        foreach ($ini_vars_actual as $key => $value) {
            if (empty($value)) {
                $ini_vars_empty[] = $key;
            }
        }
        if (!empty($ini_vars_empty)) {
            throw new IniVarsEmptyException($ini_vars_empty);
        }

        return true;
    }

    public static function savePersonalData($first_name, $last_name, $phone) {
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
        self::$firstName = $first_name;
        self::$lastName = $last_name;
        self::$phone = $phone;
    }
}
