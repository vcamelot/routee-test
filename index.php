<?php
namespace Routee\DVTest;
use Routee\DVTest\Classes\IniVars;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization');

spl_autoload_register(function ($className) {
    $file = str_replace("Routee\DVTest", "", $className) . ".php";
    if (file_exists("src/" . $file)) {
        require_once("src/" . $file);
    } else {
        throw new \Exception("Class " . $className . " not defined");
    }
});

// Initialize and validate configuration variables
try {
    IniVars::test();
} catch (\Exception $e) {
    echo $e->getMessage();
}