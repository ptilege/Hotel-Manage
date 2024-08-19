<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Offer extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $appends = ['image'];

    public function getImageAttribute() {
        $image = $this->getFirstMediaUrl('Offer');
        return $image;
    }

    public function property() {
        return $this->belongsTo(Property::class);
    }
}
