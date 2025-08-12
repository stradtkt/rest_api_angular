<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static create(array $validated)
 * @method static findOrFail($id)
 * @method static count()
 */
class Post extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['user_id', 'title', 'content'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function comments(): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Relations\HasMany|Post
    {
        return $this->hasMany(Comment::class);
    }
}

