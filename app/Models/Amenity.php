<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Amenity extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    
    public function properties() {
        return $this->belongsToMany(Property::class);
    }
}
