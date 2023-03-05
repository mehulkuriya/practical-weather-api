<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GenerateUuidTrait;

class OpenWeatherConfiguration extends Model
{
    use HasFactory,GenerateUuidTrait;
    
    protected $fillable = ['uuid','api_url','config_key'];
}
