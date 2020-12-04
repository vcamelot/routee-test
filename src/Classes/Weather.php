<?php

namespace vcamelot\RouteeTest\Classes;

use GuzzleHttp;
use GuzzleHttp\Psr7;

use GuzzleHttp\Exception\ClientException;
use vcamelot\RouteeTest\Classes\IniVars;
use vcamelot\RouteeTest\Exceptions\WeatherMap\MapAPIException;

class Weather
{

    /**
     * Empty constructor
     * 
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Gets temperature for specified city
     * 
     * @return float
     * @throws vcamelot\RouteeTest\Exceptions\WeatherMap\MapAPIException;
     */
    public function getTemperature()
    {
        $client = new GuzzleHttp\Client();
        try {
            $res = $client->request(
                'GET',
                'api.openweathermap.org/data/2.5/weather?q=' . IniVars::$city .
                    '&appid=' . IniVars::getAPIKey() . '&units=metric',
            );

            $weather_array = json_decode($res->getBody(), true);

            // Check if there is temperature entry in the response
            if (!isset($weather_array['main']['temp'])) {
                throw new MapAPIException('Could not find temperature in API response');
            }
            $temp = $weather_array['main']['temp'];
            return floatval($temp);
        } catch (ClientException $e) {
            // In case of failure (probably wrong city name) raise a custom exception
            $response = Psr7\Message::toString($e->getResponse());

            // OpenWeather API returns error message in the header,
            // and we need to parse it to get its JSON
            $pattern = '/{(.*?)}/';
            preg_match_all($pattern, $response, $matches);
            if (isset($matches[0][0])) {
                $api_error = json_decode($matches[0][0], true);
                $error_msg = $api_error['message'] ?? 'Unrecognized API error';
            } else {
                $error_msg = 'Unrecognized API error';
            }

            throw new MapAPIException($error_msg);
        }
    }
}
