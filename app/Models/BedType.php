<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BedType extends Model
{
    use HasFactory;

    protected $appends = ['property_id', 'quantity'];

    public function getPropertyIdAttribute()
    {
        return $this->bedTypeProprty() ? $this->bedTypeProprty()->property_id : null;
    }
    public function getQuantityAttribute()
    {
        return $this->bedTypeProprty() ? $this->bedTypeProprty()->quantity : null;
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class)->withPivot('quantity', 'status');
    }
    public function rooms()
    {
        return $this->belongsToMany(Room::class);
    }

    public function bedTypeProprty()
    {
        $ids = array_unique($this->rooms()->pluck('property_id')->toArray());
        return BedTypeProperty::whereIn('property_id', $ids)->where('bed_type_id', $this->id)->first();
    }
}
