<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experiences extends Model
{
    use HasFactory;
    protected $fillable = [
        'office_name',
        'designation',
        'year_of_experience',
        'status'
    ];
}
