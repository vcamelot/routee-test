<?php

namespace vcamelot\RouteeTest\Classes;

use vcamelot\RouteeTest\Classes\BaseTransfer;
use vcamelot\RouteeTest\Classes\IniVars;
use vcamelot\RouteeTest\Exceptions\RouteeAPI\RouteeAPIException;

class SMSTransfer extends BaseTransfer
{
    private $routeeToken;

    /**
     * Empty constructor
     * 
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get OAuth token from Routee API, save to private variable
     * 
     * @return void
     * @throws vcamelot\RouteeTest\Exceptions\RouteeAPI\RouteeAPIException;
     */
    private function getToken()
    {
        $auth_header = base64_encode(IniVars::getAppId() . ":" . IniVars::getAppSecret());

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://auth.routee.net/oauth/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "grant_type=client_credentials",
            CURLOPT_HTTPHEADER => array(
                "authorization: Basic {$auth_header}",
                "content-type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new RouteeAPIException($err);
        }

        $response_array = json_decode($response, true);
        $this->routeeToken = $response_array['access_token'];
    }

    /**
     * Send SMS message with temperature
     * 
     * @param float $temperature
     * @return string
     * @throws vcamelot\RouteeTest\Exceptions\RouteeAPI\RouteeAPIException;
     */
    public function send($temperature)
    {
        $this->getToken();

        $curl = curl_init();

        $temperatureThreshold = IniVars::getTemperatureThreshold();
        $body = [
            'body' => IniVars::$firstName . " " . IniVars::$lastName .
                " Temperature " . ($temperature >= $temperatureThreshold ? "more" : "less") .
                " than " . $temperatureThreshold . " C. It is " . $temperature . " C",
            'to' => IniVars::$phone,
            'from' => 'amdTelecom'
        ];

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://connect.routee.net/sms",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($body, true),
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer " . $this->routeeToken,
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new RouteeAPIException($err);
        }

        $response_array = json_decode($response, true);
        return $response_array['status'];
    }
}
