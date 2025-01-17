<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Blog extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $table = 'blogs'; 
    protected $primaryKey = 'id'; 
    protected $fillable = ['title', 'description', 'image','status']; 
}
