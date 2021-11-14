<?php

namespace Modules\Post\Entities;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Modules\Category\Entities\Category;

class Post extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = ['title', 'body', 'created_by', 'category_id'];

    protected static function newFactory(): Factory
    {
        return PostFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function status(): belongsTo
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function subscribers(): MorphToMany
    {
        return $this->morphToMany(User::class, 'subscribable');
    }
}
