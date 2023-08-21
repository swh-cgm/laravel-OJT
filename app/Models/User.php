<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    const ADMIN_ROLE = 1;
    const MEMBER_ROLE = 2;
    const ADMIN = "Admin";
    const MEMBER = "Member";

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
