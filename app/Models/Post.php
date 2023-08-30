<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $fillable = [
        'title',
        'description',
        'public_flag',
        'created_by',
        'updated_by'
    ];
    use HasFactory;

    /**
     * Can the current user edit the post.
     *
     * @return boolean
     */
    public function getCanEditAttribute(): bool
    {
        return Auth::check() ? (Auth::user()->isAdmin()) || (Auth::user()->id == $this->created_by) : false;
    }

    /**
     * Get the comments for the post
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Laravel relationship: post belongs to user
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
