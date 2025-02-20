<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'title_bn',
        'details',
        'details_bn',
        'training_date',
        'training_time',
        'training_duration',
        'training_fee',
        'image',
        'status',
    ];
}
