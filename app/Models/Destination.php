<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Destination extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $appends = ['image'];

    public function getImageAttribute() {
        $image = $this->getFirstMediaUrl('Destination');
        return $image;
    }

    public function activities() {
        return $this->belongsToMany(Activity::class);
    }
    public function destinationFeatures() {
        return $this->belongsToMany(DestinationFeature::class);
    }

    public function properties() {
        return $this->belongsToMany(Property::class);
    }
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function features()
    {
        return $this->belongsToMany(DestinationFeature::class, 'destination_destination_feature', 'destination_id', 'destination_feature_id');
    }
}

