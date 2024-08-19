<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class PropertyType extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $appends = ['image', 'property_count'];

    public function getImageAttribute() {
        $image = $this->getFirstMediaUrl('propertyType');
        return $image;
    }
    
    public function getPropertyCountAttribute() {
        return $this->properties()->count();
    }

    public function properties() {
        return $this->hasMany(Property::class);
    }
   
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

}
