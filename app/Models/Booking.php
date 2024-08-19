<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $with = ['items', 'transaction'];

    public function items() {
        return $this->hasMany(BookingItem::class);
    }

    public function transaction() {
        return $this->hasOne(Transaction::class);
    }

    public function property() {
        return $this->belongsTo(Property::class);
    }

}
