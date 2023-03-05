<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OpenWeatherConfiguration as WeatherConfigurationModel;

class OpenWeatherConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $weatherInfo = WeatherConfigurationModel::firstOrNew(
            [
                "api_url"=> 'http://api.openweathermap.org/'
            ]
        );
        $weatherInfo->fill([
            "api_url"=> 'http://api.openweathermap.org/',
            "config_key" => '858f15fed9292cbe25c341a754c55e45'
        ]);
        $weatherInfo->save();
    }
}
