<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allotment extends Model
{
    use HasFactory;

    public function room() {
        return $this->hasOne(Room::class, 'id', 'room_id');
    }
}
