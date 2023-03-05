<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GenerateUuidTrait;

class CityWeather extends Model
{
    use HasFactory,GenerateUuidTrait;
}
