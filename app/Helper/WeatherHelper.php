<?php

namespace App\Helper;

use App\Models\City;
use App\Models\OpenWeatherConfiguration;
use App\Models\WeatherApiLog;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;

class WeatherHelper
{
    /**
     * @var apiUrl
     */
    private $apiUrl;

    /**
     * @var apiKey
     */
    private $apiKey;


    public function __construct()
    {
        $credentials = $this->fetchCredentials();

        $this->apiUrl = $credentials->api_url;
        $this->apiKey = $credentials->config_key;
    }

    /**
     * fetch open weather api credentials
     *
     * @throws Exception
     */
    public function fetchCredentials()
    {
        return OpenWeatherConfiguration::select('api_url', 'config_key')->first();
    }

    /**
     * Call the open weather map api
     * 
     * @param string $url
     * @param array $data
     * @return object
     */
    public function callApi($url, $data)
    {
        try {
            $data = Arr::add($data, 'appid', $this->apiKey);

            $response = Http::get($this->apiUrl . $url, $data);

            //Create log entry in database
            WeatherApiLog::create([
                'request_parameters' => json_encode($data),
                'api_response' => json_encode($response),
            ]);

            if ($response->status() == 200 || $response->status() == 201) {
                return $response->json();
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Fetch the 5 days weather of city
     * @return object
     */
    public function fetchWeather($city)
    {
        // Call open weather map api
        $data = [
            'q' => $city
        ];
       
        $weatherData = $this->callApi('data/2.5/forecast', $data);
        $cityInfo = City::updateOrCreate(
            ['name' => $city],
            ['weather_info' => json_encode($weatherData)]
        );
        return true;
    }
}
