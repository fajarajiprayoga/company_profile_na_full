<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type_id',
        'slug',
        'description',
        'brand',
        'images',
        'height',
        'width',
        'length',
        'lighting',
        'couches',
        'interior',
        'exterior',
        'driver_station',
        'gallery',
        'video',
        'lighting_images',
        'couches_images',
        'interior_images',
        'exterior_images',
        'driver_station_images',
        'wallpaper',
        'show_in_home',
        'home_photo'
    ];
    protected $casts = [
        'gallery' => 'array',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}
