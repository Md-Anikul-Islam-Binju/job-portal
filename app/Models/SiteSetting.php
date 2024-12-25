<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'name_bn',
        'title',
        'title_bn',
        'short_description',
        'short_description_bn',
        'site_preview_image',
        'favicon',
        'logo',
        'email',
        'phone',
        'phone_bn',
        'address',
        'address_bn',
        'site_link',
        'facebook_link',
        'twitter_link',
        'linkedin_link',
        'youtube_link',
    ];
}
