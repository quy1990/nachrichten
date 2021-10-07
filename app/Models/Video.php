<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Video extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name'];

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function subscribes(): MorphToMany
    {
        return $this->morphToMany(User::class, 'subscribable');
    }
}
