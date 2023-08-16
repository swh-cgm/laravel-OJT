<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'email','password','name','img','role', 'created_by', 'updated_by'
    ];

    use HasFactory;
}
