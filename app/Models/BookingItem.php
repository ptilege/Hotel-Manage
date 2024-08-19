<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingItem extends Model
{
    use HasFactory;

    protected $with = ['bedType', 'mealType','room'];
    
    public function bedType() {
        return $this->belongsTo(BedType::class, 'bed_type');
    }
    public function mealType() {
        return $this->belongsTo(MealType::class,'meal_type');
    }
    public function room() {
        return $this->belongsTo(Room::class);
    }
}
