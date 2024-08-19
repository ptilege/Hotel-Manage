<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Room extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;


    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function bedTypes() {
        return $this->belongsToMany(BedType::class);
    }

    public function mealTypes() {
        return $this->belongsToMany(MealType::class);
    }
}
