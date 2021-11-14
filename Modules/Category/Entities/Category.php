<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Modules\Category\Database\Factories\CategoryFactory;
use Modules\Image\Entities\Post;
use Modules\Image\Entities\User;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public $timestamps = false;

    protected static function newFactory(): Factory
    {
        return CategoryFactory::new();
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function subscribers(): MorphToMany
    {
        return $this->morphToMany(User::class, 'subscribable');
    }
}
