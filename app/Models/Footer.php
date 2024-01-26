<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'youtube_url',
        'instagram_url',
        'instagram_username',
        'facebook_url',
        'shopee_url',
        'tokopedia_url',
        'email',
        'background_product',
        'background_contact',
        'background_download_center',
        'background_career'
    ];
}
