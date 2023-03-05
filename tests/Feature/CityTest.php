<?php
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\City;
use App\Models\State;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(WithFaker::class,RefreshDatabase::class);

beforeEach(function () {
    $this->dataArr = [
        "name" => $this->faker->name,
        "state_uuid" => $this->faker->uuid,
    ];
});
it('Test City Name Required', function () {
    $response = $this->postJson('/api/v1/city/add',['Accept' => 'application/json']);
    $response->assertStatus(422)->assertJson([  
        "message" => "The name field is required.",
   ]);
});

it('Test City Unique Name Validation', function () {

    $response = $this->postJson('/api/v1/city/add', $this->dataArr,['Accept' => 'application/json']);
    $response->assertStatus(422);
});

it('Test State Uuid Required Validation', function () {
    unset($this->dataArr["state_uuid"]);
    $response = $this->postJson('/api/v1/city/add', $this->dataArr,['Accept' => 'application/json']);
    $response->assertStatus(422)
    ->assertJson([  
        "message" => "The state uuid field is required.",
   ]);
});

it('Test State Uuid Invalid Validation', function () {

    $response = $this->postJson('/api/v1/city/add',$this->dataArr,['Accept' => 'application/json']);
    $response->assertStatus(422)
    ->assertJson([  
        "message" => "The selected state uuid is invalid.",
   ]);

});

it('Test Add City Successfully', function () {
    $this->artisan('db:seed');
    $stateInfo = State::factory()->create();
    $dataArr = $this->dataArr;
    $dataArr["state_uuid"] = $stateInfo["uuid"];
    $response = $this->postJson('/api/v1/city/add',$dataArr,['Accept' => 'application/json']);
    $response->assertStatus(200)
    ->assertJsonStructure(
        [
            'data' => [
                'name',
                'state_uuid',
                'uuid',
                'created_at',
                'updated_at',
            ],
            "message"
        ]
    );
   
});

