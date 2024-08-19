<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Partner extends BaseModel implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['position'];

    protected $appends = ['image'];

    public function getImageAttribute() {
        $image = $this->getFirstMediaUrl('Partners');
        return $image;
    }
    public function properties()
    {
        return $this->belongsTo(Property::class);
    }
}
