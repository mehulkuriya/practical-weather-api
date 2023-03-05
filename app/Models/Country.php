<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GenerateUuidTrait;

class Country extends Model
{
    use HasFactory,GenerateUuidTrait;
    protected $fillable = ['uuid','short_code','name','country_code'];
}
