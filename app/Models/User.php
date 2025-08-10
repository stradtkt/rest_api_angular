<?php

namespace App\Models;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed $name
 * @method static findOrFail($id)
 * @method static create(array $array)
 * @method static where(string $string, mixed $email)
 * @method static count()
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'avatar',
        'bio',
        'website',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    // Optional: if using custom pivot model UserRole
    public function userRoles(): HasMany
    {
        return $this->hasMany(UserRole::class);
    }
    public function post(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Post::class);
    }
    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function upload(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'image' => 'required|image|max:2048'
        ]);

        $file = $request->file('image');

        if (ImageHelper::isValidImage($file)) {
            $filename = ImageHelper::saveImage($file, 'uploads');
            $thumb = ImageHelper::createThumbnail($file, 'uploads/thumbnails');

            return response()->json([
                'image' => $filename,
                'thumbnail' => $thumb
            ]);
        }

        return response()->json(['error' => 'Invalid image type.'], 400);
    }
}
