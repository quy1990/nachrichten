<?php

namespace Modules\Tag\Entities;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Tag\Database\Factories\TaggableFactory;
use Modules\User\Database\factories\UserFactory;

class Taggable extends Model
{
    use HasFactory;

    protected $primaryKey = null;

    public $incrementing = false;

    public $timestamps = false;

    protected static function newFactory(): Factory
    {
        return TaggableFactory::new();
    }

}
