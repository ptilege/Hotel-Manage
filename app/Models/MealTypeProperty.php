<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealTypeProperty extends Model
{
    protected $table = 'meal_type_property';

    public function mealType()
    {
        return $this->belongsTo(MealType::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
