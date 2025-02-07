<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // ✅ Add this

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; // ✅ Add HasApiTokens

    protected $fillable = [
        'name',
        'email',
        'mobileNumber',
        'dob',
        'address',
        'course_type',
        'password',
        'role'
    ];

    protected $hidden = ['password'];

    protected $casts = [
        'dob' => 'date',
    ];
}

