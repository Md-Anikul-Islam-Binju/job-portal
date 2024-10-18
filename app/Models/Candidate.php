<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'linkedIn',
        'facebook',
        'father_name',
        'mother_name',
        'dob',
        'hobby',
        'blood_group',
        'nid',
        'work_knowledge',
        'verification_code',
        'password',
    ];
}
