<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Subscribe extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function posts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'subscribable');
    }

    public function videos(): MorphToMany
    {
        return $this->morphedByMany(Video::class, 'subscribable');
    }

    public function tags(): MorphToMany
    {
        return $this->morphedByMany(Tag::class, 'subscribable');
    }

    public function categories(): MorphToMany
    {
        return $this->morphedByMany(Category::class, 'subscribable');
    }

    public function comments(): MorphToMany
    {
        return $this->morphedByMany(Comment::class, 'subscribable');
    }
}
