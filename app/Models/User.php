<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements CanResetPassword
{
    use Notifiable;
    protected $fillable = [
        'email',
        'password',
        'name',
        'img',
        'role',
        'created_by',
        'updated_by'
    ];

    use HasFactory;
}
