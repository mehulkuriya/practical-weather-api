<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class CountryStateCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $countryInfo =  $this->saveCountryInfo("India","IN","91");
       $stateInfo   =  $this->saveStateInfo("Gujarat",$countryInfo);
       $this->saveCityInfo("Ahmedabad",$stateInfo);
       $this->saveCityInfo("Vadodara",$stateInfo);
    }


    public function saveCountryInfo($countryName,$shortCode,$countryCode)
    {
        $countryInfo = Country::firstOrNew(
            [
                "name"=> $countryName
            ]
        );
        $countryInfo->fill([
            "name" => $countryName,
            "short_code" => $shortCode,
            "country_code" => $countryCode,
        ]);
        $countryInfo->save();

        return $countryInfo;
    }

    public function saveStateInfo($stateName,$countryInfo)
    {
        $stateInfo = State::firstOrNew(
            [
                "uuid"=> "7cb5fb96-4a32-4793-abe2-0c1c9f781ea2",
                "name"=> $stateName
            ]
        );
        $stateInfo->fill([
            "name"=> $stateName,
            "country_uuid" => $countryInfo->uuid
        ]);
        $stateInfo->save();

        return $stateInfo;
    }


    public function saveCityInfo($cityName,$stateInfo)
    {
        $cityInfo = City::firstOrNew(
            [
                "name"=> $cityName
            ]
        );
        $cityInfo->fill([
            "name"=> $cityName,
            "state_uuid" => $stateInfo->uuid
        ]);
        $cityInfo->save();
    }
}
