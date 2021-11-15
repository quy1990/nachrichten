<?php

namespace Modules\Tag\Entities;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Modules\Post\Entities\Post;
use Modules\Tag\Database\Factories\TagFactory;
use Modules\User\Entities\User;
use Modules\Video\Entities\Video;

class Tag extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name'];

    protected static function newFactory(): Factory
    {
        return TagFactory::new();
    }

    public function posts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    public function videos(): MorphToMany
    {
        return $this->morphedByMany(Video::class, 'taggable');
    }

    public function subscribers(): MorphToMany
    {
        return $this->morphToMany(User::class, 'subscribable');
    }
}
