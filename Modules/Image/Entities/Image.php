<?php

namespace Modules\Image\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'imageable_id', 'imageable_type'];

    public $timestamps = false;

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
