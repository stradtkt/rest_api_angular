<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail($id)
 * @method static create(array $validated)
 * @method static count()
 */
class Jobs extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'client_id',
        'title',
        'status',
        'start_date',
        'due_date',
        'budget',
        'amount_spent',
        'priority',
        'location',
        'description'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Clients::class);
    }
}
