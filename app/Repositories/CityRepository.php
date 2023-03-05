<?php

namespace App\Repositories;

use App\Helper\WeatherHelper;
use App\Models\City;
use Illuminate\Http\Request;
use Carbon\Carbon;
/**
 * Class CityRepository.
 */
class CityRepository
{
    /**
     * function to store city
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        $cityInfo = new City;
        $cityInfo->fill($request->all());
        $cityInfo->save();
        return $cityInfo;
    }

    /**
     * function fetch weather by city
     *
     * @param Array $request
     */
    public function fetchCityWeather($request)
    {
        if($request->has('city')){
            $city = City::where('name', ucfirst($request['city']))->get();
        }
        else{
            $city = City::get();
        }
       
        $dataArr = [];
        if($city->isNotEmpty()) {         
            $dataArr = $this->formatWeatherData($city);
        }
       
        return $dataArr;
    }


    /**
     *  Generate Date range Array 
     */
    public function generateDateRange(Carbon $start_date, Carbon $end_date) : array
    {
        $dates = [];
        for($date = $start_date->copy(); $date->lte($end_date); $date->addDay()) {
            $dates[] = $date->format('Y-m-d');
        }

        return $dates;
    }

    /**
     * FormatWeather Data function  
     * Return Array
     */
    private function formatWeatherData($city) : Array
    {
        $dataArr = [];
        $dateValueArr = $this->generateDateRange(Carbon::now(),Carbon::now()->addDays(5));
        foreach($city as $cityValue)
        {
         $weatherInfo = json_decode($cityValue["weather_info"],1);
         if(!empty($weatherInfo["list"]))
         {
            for($i=0;$i<=$weatherInfo["cnt"];$i++)
            {
                $dataArr[$weatherInfo["city"]["name"]]["name"] = $weatherInfo["city"]["name"];
                $dataArr[$weatherInfo["city"]["name"]]["coord"] = $weatherInfo["city"]["coord"];  
                foreach($weatherInfo["list"] as $value)
                {
                    $dateTxt = Carbon::parse($value["dt_txt"])->format('Y-m-d');   
                    if(in_array($dateTxt,$dateValueArr)){
                        $now = Carbon::now();
                        $datework = Carbon::createFromDate($dateTxt);
                        $dayDiff = $datework->diffInDays($now);
                        $dayText = "Day ".$dayDiff;
                        $formatArr[$dayText]["date"]  = $value["dt_txt"];
                        $formatArr[$dayText]["temp"] = $value["main"]["temp"];
                        $formatArr[$dayText]["temp_max"] = $value["main"]["temp_max"];
                        $formatArr[$dayText]["temp_min"] = $value["main"]["temp_min"];
                        $formatArr[$dayText]["humidity"] = $value["main"]["humidity"];
                        $formatArr[$dayText]["visibility"] = $value["weather"][0]["main"];
                        $formatArr[$dayText]["wind_speed"] = $value["wind"]["speed"];
                     }
                   
                }
                $dataArr[$weatherInfo["city"]["name"]]["weather"] = $formatArr;
            }

         }
        }

        return $dataArr;
    }
}
