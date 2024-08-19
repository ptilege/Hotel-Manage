<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Property extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $with = ['propertyType', 'amenities'];

    protected $appends = ['image', 'base_currency'];

    protected $fillable = [
        'name',
        'slug',
        'property_type_id',
        'email',
        'contact_1',
        'address_1',
        'destination_id',
        'video_url',
        'description',
        'stars',
        'country_id',
        'status',
    ];

    public function getImageAttribute() {
        $image = $this->getFirstMediaUrl('Property');
        return $image;
    }
    public function getBaseCurrencyAttribute() {
        $image = $this->getFirstMediaUrl('Property');
        return $image;
    }
    public function getSecondaryCurrencyAttribute() {
        $image = $this->getFirstMediaUrl('Property');
        return $image;
    }
    public function propertyType() {
        return $this->belongsTo(PropertyType::class);
    }
    public function amenities() {
        return $this->belongsToMany(Amenity::class);
    }
    public function reviews() {
        return $this->belongsToMany(Review::class);
    }
    public function facilities() {
        return $this->belongsToMany(Facilities::class);
    }
    public function rooms() {
        return $this->hasMany(Room::class);
    }
    public function partner()
    {
        return $this->belongsTo(Partner::class); // Define the 'belongsTo' relationship with the 'Partner' model
    }
    public function mealTypes() {
        return $this->belongsToMany(MealType::class)->withPivot('status');
    }
    public function bedTypes() {
        return $this->belongsToMany(BedType::class)->withPivot('status', 'quantity');
    }

    public function featuredMedia() {
        return $this->media()->whereJsonContains('custom_properties', ['category'=>'featured']);
    }

    public function rates() {
        return $this->hasMany(Rate::class);
    }
    public function users() {
        return $this->belongsToMany(User::class, 'property_backend_user', 'property_id', 'backend_user_id');
    }

    public function offers() {
        return $this->hasMany(Offer::class);
    }
    public function bookings() {
        return $this->hasMany(Booking::class);
    }
    public function destination() {
        return $this->belongsTo(Destination::class);
    }
    public function currencies() {
        return $this->belongsToMany(Currency::class)->withPivot('default');
    }
}
