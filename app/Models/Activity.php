<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    // Example: Define a relationship with the 'destinations' table through a pivot table 'activity_destination'
    public function destinations()
    {
        return $this->belongsToMany(Destination::class, 'activity_destination', 'activity_id', 'destination_id');
    }

    // Additional methods, scopes, or attributes can be added here
}
