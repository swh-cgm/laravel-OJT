<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $fillable = [
        'title','description','public_flag','created_by','updated_by'
    ];
    use HasFactory;

    public function getCanEditAttribute(): bool
    {
        return Auth::check() ? Auth::user()->id == $this->created_by : false;
    }
}
