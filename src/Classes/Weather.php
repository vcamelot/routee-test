<?php

namespace vcamelot\RouteeTest\Classes;

use GuzzleHttp;
use vcamelot\RouteeTest\Classes\IniVars;

class Weather
{
    public function getWeather()
    {
        $client = new GuzzleHttp\Client();
        $res = $client->request('GET', 
            'api.openweathermap.org/data/2.5/weather?q={city}&appid={API key}', [
            'auth' => ['user', 'pass']
        ]);
    }
}
