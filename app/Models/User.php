<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements CanResetPassword
{
    use Notifiable;
    use HasFactory;
    protected $fillable = [
        'email',
        'password',
        'name',
        'img',
        'role',
        'created_by',
        'updated_by'
    ];
    
    public function getCanEditAttribute(): bool
    {
        return Auth::check() ? (Auth::user()->role==1) : false;
    }
}
