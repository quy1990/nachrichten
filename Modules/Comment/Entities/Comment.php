<?php

namespace Modules\Comment\Entities;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Modules\Comment\Database\Factories\CommentFactory;
use Modules\User\Entities\User;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];


    protected static function newFactory(): Factory
    {
        return CommentFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subscribers(): MorphToMany
    {
        return $this->morphToMany(User::class, 'subscribable');
    }
}
