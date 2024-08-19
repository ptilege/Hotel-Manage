<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

       protected $fillable = [
        'property_id',
        'user_id',
        'comfort',
        'facilities',
        'cleanliness',
        'valueformoney',
        'location',
        'staff',
        'heading',
        'comment',
    ];
}
