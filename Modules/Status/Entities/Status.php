<?php

namespace Modules\Status\Entities;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Post\Entities\Post;
use Modules\Status\Database\factories\StatusFactory;

class Status extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected static function newFactory(): Factory
    {
        return StatusFactory::new();
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
