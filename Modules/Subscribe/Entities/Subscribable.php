<?php

namespace Modules\Subscribe\Entities;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Subscribe\Database\factories\SubscribableFactory;

class Subscribable extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = null;

    public $incrementing = false;

    protected $fillable = ['user_id', 'subscribable_id', 'subscribable_type'];

    protected static function newFactory(): Factory
    {
        return SubscribableFactory::new();
    }
}
