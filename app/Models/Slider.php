<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'title_bn',
        'details',
        'details_bn',
        'image',
        'link',
        'status',
    ];
}
