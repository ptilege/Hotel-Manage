<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationFeature extends Model
{
    public function destinations()
    {
        return $this->belongsToMany(Destination::class, 'destination_destination_feature', 'destination_feature_id', 'destination_id');
    }
    use HasFactory;
}
