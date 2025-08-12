<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $validated)
 * @method static findOrFail($id)
 * @method static count()
 */
class Clients extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'company_name',
        'industry',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'notes'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function jobs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Jobs::class);
    }
}
