<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GenerateUuidTrait;

class City extends Model
{
    use HasFactory,GenerateUuidTrait;
    protected $fillable = ['uuid','name','state_uuid','weather_info'];
}
