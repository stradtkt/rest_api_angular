<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @method static findOrFail($id)
 * @method static where(string $string, int|string|null $id)
 * @method static forUser(int $userId)
 * @property mixed $receiver
 * @property mixed $sender
 * @property mixed $sender_id
 */
class Friendship extends Model
{
    use HasFactory;

    protected $fillable = ['sender_id', 'receiver_id', 'status'];

    public function sender(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function scopeForUser(Builder $query, int $userId): Builder
    {
        return $query->where(function ($query) use ($userId) {
            $query->where('sender_id', $userId)
                ->orWhere('receiver_id', $userId);
        });
    }

    public function scopeAccepted(Builder $query): Builder
    {
        return $query->where('status', 'accepted');
    }

}
