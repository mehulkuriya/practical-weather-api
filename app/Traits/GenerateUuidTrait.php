<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait GenerateUuidTrait
{
    
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    // Tells the database not to auto-increment this field
    public function getIncrementing ()
    {
        return false;
    }

    // Helps the application specify the field type in the database
    public function getKeyType ()
    {
        return 'string';
    }

    // get column name for the uuid field 
    public function getKeyName()
    {
        return 'uuid';
    }
}
