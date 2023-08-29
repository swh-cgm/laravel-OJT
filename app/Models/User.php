<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
    /**
     * Current user can edit or not.
     *
     * @return boolean
     */
    public function getCanEditAttribute(): bool
    {
        return Auth::check() ? (Auth::user()->role == config('constants.user_role.admin_no')) : false;
    }
    
    /**
     * Check if the current user is Admin.
     *
     * @return boolean
     */
    public function isAdmin(): bool
    {
        return $this->role == config('constants.user_role.admin_no');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
