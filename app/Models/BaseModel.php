<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model {
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->position = self::max('position') + 1;
        });
    }
}