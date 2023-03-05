<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherApiLog extends Model
{
    use HasFactory;

    protected $fillable = ['request_parameters','api_response'];
}
