<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'verification_code',
        'role',
        'password',
        'email_verified_at',

        //user extra
        'name_bn',
        'father_name',
        'father_name_bn',
        'mother_name',
        'mother_name_bn',
        'nationality',
        'nationality_bn',
        'blood_group',
        'blood_group_bn',
        'nid',
        'dob',
        'cv',
        'resume',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];
}
