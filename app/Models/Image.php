<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'imageable_id', 'imageable_type'];

    public $timestamps = false;

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    public function subscribes(): MorphToMany
    {
        return $this->morphToMany(Subscribe::class, 'subscribable');
    }
}
