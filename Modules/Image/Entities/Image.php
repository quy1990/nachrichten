<?php

namespace Modules\Image\Entities;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Modules\Image\Database\factories\ImageFactory;

class Image extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['url', 'imageable_id', 'imageable_type'];

    protected static function newFactory(): Factory
    {
        return ImageFactory::new();
    }

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
