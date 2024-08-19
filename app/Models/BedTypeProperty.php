<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BedTypeProperty extends Model
{
    protected $table = 'bed_type_property';

    public function bedType()
    {
        return $this->belongsTo(BedType::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
