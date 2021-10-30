<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'created_by');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(comment::class);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function images(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function subscribers(): MorphToMany
    {
        return $this->morphToMany(User::class, 'subscribable');
    }

    public function subscribedUsers(): MorphToMany
    {
        return $this->morphToMany(User::class, 'subscribable');
    }

    public function subscribedPosts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'subscribable');
    }

    public function subscribedVideos(): MorphToMany
    {
        return $this->morphedByMany(Video::class, 'subscribable');
    }

    public function subscribedCategories(): MorphToMany
    {
        return $this->morphedByMany(Category::class, 'subscribable');
    }

    public function subscribedComments(): MorphToMany
    {
        return $this->morphedByMany(Comment::class, 'subscribable');
    }

    public function subscribedTags(): MorphToMany
    {
        return $this->morphedByMany(Tag::class, 'subscribable');
    }
}
