<?php
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\City;
use App\Models\State;

uses(WithFaker::class,RefreshDatabase::class);

it('fetch city weather list', function () {
    $response = $this->get("/api/v1/fetch-city-weather");
    $response->assertStatus(200);
});

it('fetch city weather list based on city', function () {
    $this->artisan('db:seed');
    $data = City::factory()->create();
    $response = $this->get("/api/v1/fetch-city-weather?city=".$data['name']);
    $response->assertStatus(200);
});


