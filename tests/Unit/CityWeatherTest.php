<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Helper\WeatherHelper;
use App\Models\City;
use App\Repositories\CityRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Carbon\Carbon;

uses(Tests\TestCase::class, RefreshDatabase::class,WithFaker::class);

it('test helper function of fetch weather', function () {
    $this->artisan('migrate');
    $this->artisan('db:seed');
    $data = City::factory()->create();
    $response =(new WeatherHelper())->fetchWeather($data["name"]);
    expect($response)->toBeBool();
});


it('test Repostory function of fetch weather', function () {
    $request = new \Illuminate\Http\Request();
    $request->request->add(['city' => $this->faker->name]);
    $response =(new CityRepository())->fetchCityWeather($request);
    expect($response)->toBeArray();
});


it('test Repostory function of date range array', function () {
    $response =(new CityRepository())->generateDateRange(Carbon::now(),Carbon::now()->addDays(5));
    expect($response)->toBeArray();
});
